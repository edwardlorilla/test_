(function() {

    // Fireworks

    // Particles limit
    // var particlesLimit = 1000;
    // var rootParticlesLimit = 50;
    // var childrenParticlesLimit = 10;
    var particlesLimit = 500;
    var rootParticlesLimit = 25;
    var childrenParticlesLimit = 5;

    var canvas = document.querySelector('.welcome-canvas');

    if (canvas == null) { return; }
    
    var ctx = canvas.getContext('2d');

    var randomBetween = function (min, max) {
        return ~~(Math.random() * (max - min + 1)) + min;
    };
    var PI2 = Math.PI * 2;

    // all set in `setStage`
    var canvasWidth;
    var canvasHeight;
    var midX;
    var midY;
    var particles = [];
    var tick = 0;
    var frame = 0;
    var frameTimer = null;

    noise.seed(Math.random());

    function Particle(options) {
        var defaults = {x: 0, y: 0, radius: 10, direction: 0, velocity: 0, explode: false};

        $.extend(this, defaults, options);

        this.velX = Math.cos(this.direction) * this.velocity;
        this.velY = Math.sin(this.direction) * this.velocity;

        this.friction = 0.9;
        this.decay = randomBetween(90, 91) * 0.01;
        this.gravity = this.radius * 0.01;
    }

    Particle.prototype.update = function () {
        this.x += this.velX;
        this.y += this.velY;

        this.velX *= this.friction;
        this.velY *= this.friction;
        this.velocity *= this.friction;

        // uncomment for a gravity like effect
        // this.velY += this.gravity;

        this.radius *= this.decay;
        this.gravity += 0.05;
    };

    var clear = function () {
        ctx.globalCompositeOperation = 'destination-out';
        ctx.fillStyle = 'hsla(0, 0%, 0%, 0.5)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.globalCompositeOperation = 'lighter';
    };

    var setStage = function () {
        clear();

        canvasWidth = 748;
        canvasHeight = 115;
        midX = canvasWidth >> 1;
        midY = canvasHeight >> 1;

        canvas.width = canvasWidth;
        canvas.height = canvasHeight;
    };

    var createParticles = function (x, y) {
        if (particles.length > particlesLimit) {
            particles.splice(0, particles.length - particlesLimit);
        }

        var numParticles = rootParticlesLimit;

        while (numParticles--) {
            var direction = Math.random() * PI2;
            var velocity = randomBetween(10, 20);
            var radius = 10 + (Math.random() * 20);
            var explode = true;
            var particle = new Particle({
                x,
                y,
                direction,
                velocity,
                radius,
                explode
            });
            particles.push(particle);
        }
    };

    var loop = function () {
        clear();

        particles.forEach(function (particle, index) {
            // determine color
            var hue = (noise.perlin2(tick, tick) * 360);
            var fill = 'hsl('+ hue +', 80%, 50%)';

            // draw and update every existing particle
            ctx.beginPath();
            ctx.fillStyle = fill;
            ctx.arc(particle.x, particle.y, particle.radius, 0, PI2);
            ctx.fill();
            ctx.closePath();

            // update particle's properties
            particle.update();

            // check if particle should explode and create new particles
            if (Math.abs(particle.radius) <= 2 && particle.explode && particles.length < particlesLimit) {
                particle.explode = false;
                var children = childrenParticlesLimit;

                while (children--) {
                    particles.push(new Particle({
                        x: particle.x,
                        y: particle.y,
                        radius: particle.radius * 4,
                        direction: Math.random() * PI2,
                        velocity: particle.velocity * (randomBetween(2, 10)),
                        explode: false
                    }));
                }
            }

            if (particle.radius <= 0.1 || particle.velocity <= 0.1) {
                particles.splice(particles.indexOf(particle), 1);
            }
        });

        tick += 0.01;

        frame++;
        frameTimer = requestAnimationFrame(loop);
    };

    var boom = function () {
        var margin = 10;
        var x = randomBetween(margin, canvasWidth - margin);
        var y = randomBetween(margin, canvasHeight - margin);
        createParticles(x, y);
    };

    setStage();
    loop();

    var fireworksTimer = setInterval(boom, 600);

})();
