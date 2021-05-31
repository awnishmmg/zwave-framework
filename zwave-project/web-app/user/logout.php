<?php


$state= Session::current();
Session::destroy();
redirect_to('login?msg=313');
