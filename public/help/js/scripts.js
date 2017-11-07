/*
 Accordion component
 */
Vue.component('accordion', {
    template: '#accordion-template',
    props: {
        title: {
            type: String,
            default: ''
        },
        open: {
            type: Boolean,
            default: false
        },
        alwaysOpen: {
            type: Boolean,
            default: false
        }
    },
    data: function () {
        return {
            openState: this.open
        }
    },
    computed: {
        isOpen: function () {
            return this.alwaysOpen || this.openState;
        }
    },
    methods: {
        toggleAccordion: function () {
            if (!this.alwaysOpen) {
                this.openState = !this.openState;
            }
        }
    }
});

/*
 Help component
 */
Vue.component('help', {
    template: '#help-template',
    data: function () {
        return {
            helpTranslated: null,
            help: {
                currentSectionIndex: 0,
                currentTopicIndex: 0,
                currentItemIndex: 0,
                sections: [
                  {
                    title: 'Help',
                    topics: [
                        {
                              title: 'Welcome',
                              content: 'Please take a moment to read the help section and best understand how to write with ilys. It is easy, we promise.' +
                              '<br/><br/>You are always encouraged to <a href="/contact-us">contact us</a> if we can assist you or answer any questions.' +
                              '<br/><br/>We wish you lots of fun and free-flowing creativity here. <3<br/><br/>',
                              items: []
                        },
                        {
                            title: 'Dashboard',
                            content: 'Use the Dashboard as your central command center. You can start or continue sessions, see your Performance stats, navigate to your stories, and contact us for help.' +
                            '<br/><br/><img src="../assets/img/help/dashboard.png"><br/><br/>',
                            items: [],
                            faqGroups: [
                              {
                                  title: 'Frequently Asked Questions:',
                                  faqs: [
                                      {
                                          question: 'Which browsers does ilys support?',
                                          answer: 'All modern browsers should work well with ilys, except for mobile-phones. This version of ilys is designed for desktop computers with full browsers. Some tablets will work with ilys, try and see.'
                                      },
                                      {
                                          question: 'When will mobile phones be supported?',
                                          answer: 'We are currently deep in the process of rebuilding ilys, which will include apps for iOS, Android and Windows phones. We expect this to launch in early 2018.'
                                      },
                                      {
                                          question: 'How can I join the beta program to help test the new ilys?',
                                          answer: '<a href="/contact-us">Send us a message</a> with your email address and intention to join the beta program, and we will add you to the program.'
                                      }
                                  ]
                              }
                          ]
                        },
                        {
                            title: 'Writing',
                            content: '',
                            items: [
                                {
                                    title: 'Layout',
                                    content: 'The writing screen looks like this:' +
                                    '<br/><br/><img src="../assets/img/help/writingScreen.png"><br/>' +
                                    '<br/><br/><img src="../assets/img/help/dashboardIcon.png">&nbsp;&nbsp;will bring you to the Dashboard.' +
                                    '<br/><br/><img src="../assets/img/help/changeWordCountGoalIcon.png">&nbsp;&nbsp;will bring you to the word-count goal. You can change it or set it to nothing. If set to nothing, you can edit your work right away.' +
                                    '<br/><br/><img src="../assets/img/help/peekIcon.png">&nbsp;&nbsp;will allow you to peek at your writing without being able to edit your work (if you have not yet reached your word-count goal).' +
                                    '<br/><br/><img src="../assets/img/help/ninjaModeSwitch.png">&nbsp;&nbsp;turns Ninja Mode on and off, which hides the one big letter on the screen for maximum stealth and flow.' +
                                    '<br/><br/><img src="../assets/img/help/goToEditingIcon.png">&nbsp;&nbsp;will bring you to the editing screen when you have reached your word-count goal.<br/><br/>',
                                    faqGroups: [
                                        {
                                            title: 'Frequently Asked Questions:',
                                            faqs: [
                                                {
                                                    question: 'Why would I want to use Ninja Mode?',
                                                    answer: 'You will want to use Ninja Mode for increased flow and maximum privacy. When everything disappears from the screen, there is nothing visible for the inner-editor to latch onto and start complaining about. With this comes the freedom to just go for it and let it all out. You know that you will be fixing typos and everything else later, but for now, you just go go go, careless, wild and free. Watch what happens to your imagination as you allow yourself this level of freedom.<br/><br/>Also, nobody around you can see what you are writing if there is nothing on the screen to look at. This is an additional layer of self-consciousness released into the void, giving you stronger wings with which to fly. Try it and see what happens.'
                                                },
                                                {
                                                    question: 'Why am I unable to delete while writing?',
                                                    answer: 'When you try to delete while writing, ilys will give you a little buzzer unless you are in Ninja Mode. This light negative reinforcement will help train you out of the habit of wanting to delete. Every time you respond to an impulse of wanting to delete, you subtly move your mind into the editing mode and out of the creative mode. We want to keep your mind in the creative mode as much as possible until it is time to edit. <br/><br/>Practice ignoring every impulse to delete and notice the improvements to your creative flow.'
                                                },
                                                {
                                                    question: 'Do I need to select a word-count goal?',
                                                    answer: 'No, you can write without a word-count goal. If you either leave it empty or enter 0, you will be able to edit your writing at any time.'
                                                },
                                                {
                                                    question: 'Is ilys saving my work as I write?',
                                                    answer: 'Yes, ilys saves your work as you write, but it is not offically "saved" until you save it to a story from the editing screen. These in-session backups are happening for emergency recovery, in-case something dreadful happens with your computer, the internet or anything in-between. Your sessions-in-progress are stored for 60 days and can be recovered from the "Recent Autosaves" link at the bottom of the Dashboard.'
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    title: 'Start New Session',
                                    content: 'From the Dashboard, click on the "Create new session" button to start writing:' +
                                    '<br/><br/><img src="../assets/img/help/startNewSession.png">' +
                                    '<br/><br/><br/>You will then be asked to enter your word-count goal:' +
                                    '<br/><br/><img src="../assets/img/help/selectWordCountGoal.png">' +
                                    '<br/><br/><br/>When you are ready to begin, click on the "GO!" button:' +
                                    '<br/><br/><img src="../assets/img/help/readyToFlow.png">' +
                                    '<br/><br/>Now start writing and just keep going, remembering that editing will happen later.<br/><br/>',
                                    faqGroups: [
                                        {
                                            title: 'Frequently Asked Questions:',
                                            faqs: [
                                                {
                                                    question: 'Can I continue a session?',
                                                    answer: 'Absolutely, ilys remembers your session-in-progress and you can continue your writing at a later time, from any computer. You will see your session-in-progress on the Dashboard when you log in.'
                                                },
                                                {
                                                    question: 'Do I need to select a word-count goal?',
                                                    answer: 'No, you can write without a word-count goal. If you either leave it empty or enter 0, you will be able to edit your writing at any time.'
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    title: 'Continue Session',
                                    content: 'If you have stopped writing in the middle of a session without saving it to a story, you can continue it.' +
                                    '<br/><br/>From the Dashboard, click on the "Continue previous session" to return to your session-in-progress,' +
                                    '<br/>or "Create new session" button to delete the previous session and start fresh:' +
                                    '<br/><br/><img src="../assets/img/help/sessionInProgress.png"><br/><br/>',
                                    faqGroups: [
                                        {
                                            title: 'Frequently Asked Questions:',
                                            faqs: [
                                                {
                                                    question: 'If I create new session, will my current session-in-progress be lost?',
                                                    answer: 'Yes, creating a new session will delete your session-in-progress. If you wish to save your session-in-progress, click the "Continue previous session" button, then go to the editing screen and save the session to a story.'
                                                },
                                                {
                                                    question: 'Can I continue a session from any computer?',
                                                    answer: 'Yes, you can continue from any computer that runs a browser that is compatible with ilys.'
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    title: 'Recover Session',
                                    content: 'If you have accidentally somehow lost your session, you can recover it by going to the <a href="/recent-autosaves">Recent Autosaves</a> link from the bottom of the Dashboard.<br/><br/>',
                                    faqGroups: [
                                        {
                                            title: 'Frequently Asked Questions:',
                                            faqs: [
                                                {
                                                    question: 'Are my recent autosaves available forever?',
                                                    answer: 'No, recent autosaves are only available for 60 days from when they are written. They are available for emergency recovery only, and should not be depended on for long-term storage. The correct way is to save your sessions from the editing screen to a story. Only then is your work considered saved.'
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            title: 'Editing',
                            content: '',
                            items: [
                                  {
                                    title: 'Layout',
                                    content: 'You can edit your work after you have reached your word-count goal. Remember to save your work when you are done with your edits. You will be able to continue your session and make further edits later from the story screen.' +
                                    '<br/><br/>The editing screen looks like this:' +
                                    '<br/><br/><img src="../assets/img/help/editingScreen.png"><br/>' +
                                    '<br/><br/><img src="../assets/img/help/editSaveButton.png">&nbsp;&nbsp;will bring you to screen where you can save your session.' +
                                    '<br/><br/><img src="../assets/img/help/editReturnToWritingIcon.png">&nbsp;&nbsp;will bring you back to the writing screen to continue your session.<br/><br/>',
                                    faqGroups: [
                                        {
                                            title: 'Frequently Asked Questions:',
                                            faqs: [
                                                {
                                                    question: 'Why is the editing experience so basic in ilys?',
                                                    answer: 'The world already has many wonderful word processors and tools for editing. We do not want to recreate them, they are already awesome at what they do. Our focus is on what they do not do: To help you get the words out in a flowing, pleasurable way. We use positive and negative reinforcement to train your neurology into a flow state, effectively hacking your psychology towards better writing. When your draft is ready and you feel you have got the raw material you want to sculpt into a polished piece, export your work into a word processor for the next stages of the production process. Our intent is to create an amazing pen to write with, not amazing erasers to delete with.'
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    title: 'Save Session',
                                    content: 'After editing your work, save your session to a story. Enter the name of a new story, or choose an already existing story to add this session to. Then name your session and click on the "Save your session" button.' +
                                    '<br/><br/><img src="../assets/img/help/saveSession.png">' +
                                    '<br/><br/>After saving your session to a story, you will be brought to the story screen.<br/><br/>'
                                }
                            ]
                        },
                        {
                            title: 'Story',
                            content: '',
                            items: [
                                {
                                  title: 'Layout',
                                  content: 'From the story screen you can add new or continue previous sessions, export the text file, rename the story and sessions, delete the story and delete individual sessions.' +
                                  '<br/><br/>The story screen looks like this, "Tales of Lorem Ipsum" is the story name and "In The Beginning.." is the name of the first session:' +
                                  '<br/><br/><img src="../assets/img/help/storyScreen.png"><br/><br/>',
                                  faqGroups: [
                                      {
                                          title: 'Frequently Asked Questions:',
                                          faqs: [
                                              {
                                                  question: 'Why is the editing experience so basic in ilys?',
                                                  answer: 'The world already has many wonderful word processors and tools for editing. We do not want to recreate them, they are already awesome at what they do. Our focus is on what they do not do: To help you get the words out in a flowing, pleasurable way. We use positive and negative reinforcement to train your neurology into a flow state, effectively hacking your psychology towards better writing. When your draft is ready and you feel you have got the raw material you want to sculpt into a polished piece, export your work into a word processor for the next stages of the production process. Our intent is to create an amazing pen to write with, not amazing erasers to delete with.'
                                              }
                                          ]
                                      }
                                  ]
                              },
                              {
                                  title: 'Rename Story',
                                  content: 'Click the story name to change it.' +
                                  '<br/><br/><img src="../assets/img/help/renameStory.png">' +
                                  '<br/><br/>When the story name turns into a textbox, enter the new name there.' +
                                  '<br/><img src="../assets/img/help/renameStoryInput.png">' +
                                  '<br/><br/><img src="../assets/img/help/confirmRename.png">&nbsp;&nbsp;will confirm and commit your changes.' +
                                  '<br/><img src="../assets/img/help/cancelRename.png">&nbsp;&nbsp;will cancel your changes.' +
                                  '<br/><br/>'
                              },
                              {
                                  title: 'Add Session',
                                  content: 'Click the <img src="../assets/img/help/addStoryAndSessionIcon.png"> icon to the right of the story name to create a new session.'
                              },
                              {
                                  title: 'Export Story',
                                  content: 'Click the <img src="../assets/img/help/exportStoryIcon.png"> icon to the right of the story name to download the entire story text.'
                              },
                              {
                                  title: 'Delete Story',
                                  content: 'Click the <img src="../assets/img/help/deleteStoryOrSessionIcon.png"> icon to the right of the story name to delete the entire story. <strong>Be very careful with this</strong>, as you cannot undo it. A deleted story is gone forever.'
                              },
                              {
                                  title: 'Rename Session',
                                  content: 'Click the session name to change it.' +
                                  '<br/><br/><img src="../assets/img/help/renameSession.png">' +
                                  '<br/><br/>When the session name turns into a textbox, enter the new name there.' +
                                  '<br/><img src="../assets/img/help/renameStoryInput.png">' +
                                  '<br/><br/><img src="../assets/img/help/confirmRename.png">&nbsp;&nbsp;will confirm and commit your changes.' +
                                  '<br/><img src="../assets/img/help/cancelRename.png">&nbsp;&nbsp;will cancel your changes.' +
                                  '<br/><br/>'                              },
                              {
                                  title: 'Continue Session',
                                  content: 'Click the <img src="../assets/img/help/continueSessionIcon.png"> icon to the right of the session name to continue this session.'
                              },
                              {
                                  title: 'Delete Session',
                                  content: 'Click the <img src="../assets/img/help/deleteStoryOrSessionIcon.png"> icon to the right of the session name to delete this session. <strong>Be very careful with this</strong>, as you cannot undo it. A deleted session is gone forever (although you <strong>might</strong> be able to still get it from Recent Autosaves).'
                              }
                            ]
                        },
                        {
                            title: 'Performance',
                            content: 'Your daily writing statistics are recorded by ilys so that you can use them to improve and strengthen your writing habit.<br/><br/>' +
                            '<img src="../assets/img/help/performanceChart.png">',
                            items: []
                        },
                        {
                            title: 'Emergency',
                            content: 'If you have accidentally somehow lost your session, you can recover it by going to the <a href="/recent-autosaves">Recent Autosaves</a> link from the bottom of the Dashboard.<br/><br/>',
                            items: [],
                            faqGroups: [
                                {
                                    title: 'Frequently Asked Questions:',
                                    faqs: [
                                        {
                                            question: 'Are my recent autosaves available forever?',
                                            answer: 'No, recent autosaves are only available for 60 days from when they are written. They are available for emergency recovery only, and should not be depended on for long-term storage. The correct way is to save your sessions from the editing screen to a story. Only then is your work considered saved.'
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            title: 'Contact Us',
                            content: 'We want to make sure you have an excellent experience with ilys. Please <a href="/contact-us">contact us</a> with your questions and let us know how we may assist you.',
                            items: []
                        },
                        {
                            title: 'Who Dunnit?',
                            content: '<div style="width: 100%; display: flex; justify-content: flex-start; flex-direction: row; margin-top: 17px;">' +
                            '<div style="">' +
                            '<a href="https://www.linkedin.com/in/michaelgurevich/" target="_new">' +
                            '<img src="../assets/img/help/oceanmike.jpg" width="100" height="100">' +
                            '</a></div><div style="align-self: center; margin-left: 23px;">' +
                            '<a href="https://www.linkedin.com/in/michaelgurevich/" target="_new">Mike Gurevich</a><br/>blocked writer&#39;s block,<br/>released the muse,<br/>danced with her.' +
                            '</div></div>',
                            items: []
                        }
                    ]
                },
                /*
                    {
                      title: 'Writing',
                      topics: [
                          {
                              title: 'Writing Sessions',
                              content: 'Writing Topic 1 Content',
                              items: [
                                  {
                                      title: 'Start New Session',
                                      content: 'From the <a href="/dashboard">Dashboard</a>, click on this button to begin a session:' +
                                      '<br/><br/><img src="../assets/img/help/startNewSession.png">' +
                                      '<br/><br/><br/>You will be asked to enter your word-count goal:' +
                                      '<br/><br/><img src="../assets/img/help/selectWordCountGoal.png">' +
                                      '<br/><br/><br/>When you are ready to begin, click on the "GO!" button:' +
                                      '<br/><br/><img src="../assets/img/help/readyToFlow.png"><br/><br/>',
                                      faqGroups: [
                                          {
                                              title: 'Frequently Asked Questions:',
                                              faqs: [
                                                  {
                                                      question: 'Can I continue a session?',
                                                      answer: 'Absolutely, ilys remembers your session-in-progress and you can continue your writing at a later time, from any computer.'
                                                  },
                                                  {
                                                      question: 'Do I need to select a word-count goal?',
                                                      answer: 'No, you can write without a word-count goal. If you either leave it empty or enter 0, you will be able to edit your writing at any time.'
                                                  }
                                              ]
                                          }
                                      ]
                                  },
                                  {
                                      title: 'Writing Topic 1 Item 2',
                                      content: 'Writing Topic 1 Item 2 Content'
                                  },
                                  {
                                      title: 'Writing Topic 1 Item 3',
                                      content: 'Writing Topic 1 Item 3 Content'
                                  }
                              ]
                          },
                          {
                              title: 'Writing Topic 2',
                              content: 'Writing Topic 2 Content',
                              items: [],
                              faqGroups: [
                                  {
                                      faqs: [
                                          {
                                              question: 'Question 3?',
                                              answer: 'Answer to question 3...'
                                          },
                                          {
                                              question: 'Question 4?',
                                              answer: 'Answer to question 4...'
                                          }
                                      ]
                                  }
                              ]
                          }
                      ]
                  },
                    {
                        title: 'Writing',
                        topics: [
                            {
                                title: 'Writing Topic 1',
                                content: 'Writing Topic 1 Content',
                                items: [
                                    {
                                        title: 'Writing Topic 1 Item 1',
                                        content: 'Writing Topic 1 Item 1 Content <br> <img src="06_writing_interface.jpg">',
                                        faqGroups: [
                                            {
                                                title: 'FAQ Group 1',
                                                faqs: [
                                                    {
                                                        question: 'Question 1?',
                                                        answer: 'Answer to question 1... <br> <img src="06_writing_interface.jpg">'
                                                    },
                                                    {
                                                        question: 'Question 2?',
                                                        answer: 'Answer to question 2... <br> <img src="06_writing_interface.jpg">'
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        title: 'Writing Topic 1 Item 2',
                                        content: 'Writing Topic 1 Item 2 Content'
                                    },
                                    {
                                        title: 'Writing Topic 1 Item 3',
                                        content: 'Writing Topic 1 Item 3 Content'
                                    }
                                ]
                            },
                            {
                                title: 'Writing Topic 2',
                                content: 'Writing Topic 2 Content',
                                items: [],
                                faqGroups: [
                                    {
                                        faqs: [
                                            {
                                                question: 'Question 3?',
                                                answer: 'Answer to question 3...'
                                            },
                                            {
                                                question: 'Question 4?',
                                                answer: 'Answer to question 4...'
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        title: 'Editing',
                        topics: [
                            {
                                title: 'Editing Topic 1',
                                content: 'Editing Topic 1 Content',
                                items: []
                            },
                            {
                                title: 'Editing Topic 2',
                                content: 'Editing Topic 2 Content',
                                items: [
                                    {
                                        title: 'Editing Topic 2 Item 1',
                                        content: 'Editing Topic 2 Item 1 Content'
                                    },
                                    {
                                        title: 'Editing Topic 2 Item 2',
                                        content: 'Editing Topic 2 Item 2 Content'
                                    }
                                ]
                            }
                        ]
                    }
                    */
                ]
            }
        }
    },
    computed: {
        helpTrans: function () {
            return this.helpTranslated ? this.helpTranslated : this.help;
        },
        currentSection: function () {
            return this.help.currentSectionIndex !== null
                ? this.helpTrans.sections[this.help.currentSectionIndex]
                : null;
        },
        currentTopic: function () {
            return this.currentSection && this.help.currentTopicIndex !== null
                ? this.currentSection.topics[this.help.currentTopicIndex]
                : null;
        },
        currentItem: function () {
            return this.currentTopic && this.help.currentItemIndex !== null
                ? this.currentTopic.items[this.help.currentItemIndex]
                : null;
        },
        helpContent: function () {
            return this.currentItem
                ? this.currentItem
                : this.currentTopic ? this.currentTopic : null;
        }
    },
    methods: {
        selectTopic: function (topicIndex, sectionIndex) {
            this.help.currentItemIndex = 0;
            this.help.currentTopicIndex = topicIndex;
            if (typeof sectionIndex !== 'undefined') {
                this.help.currentSectionIndex = sectionIndex;
            }
        },
        selectItem: function (itemIndex) {
            this.help.currentItemIndex = itemIndex;
        },
        faqId: function (faqIndex) {
            return `${this.help.currentSectionIndex}${this.help.currentTopicIndex}${this.help.currentItemIndex}${faqIndex}`;
        }
    }
});

new Vue({
    el: '#app',
    data: {
    }
});
