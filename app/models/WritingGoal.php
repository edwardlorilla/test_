<?php

class WritingGoal extends Eloquent {
  protected $fillable = ['user_id', 'name', 'start_at', 'end_at', 'word_count_goal', 'current_word_count'];
  protected $table = 'writing_goals';
}
