<?php

class AppEvent extends LocationModel {
    protected $table = 'events';
    public function media() {
        return $this->hasMany('EventMedia');
    }
} 