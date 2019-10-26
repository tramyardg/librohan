<?php

/*
 * https://stackoverflow.com/questions/1528280/how-to-implement-enum-like-functionality-in-php
 * Implements the abstract base for all enum types
 * @see http://stackoverflow.com/a/2324746/1003020
 * @see http://stackoverflow.com/a/254543/1003020
 */

class BookCategory extends Enum
{
    const Biography = 0;
    const Fiction   = 1;
    const History   = 2;
    const Mystery   = 3;
    const Suspense  = 4;
    const Thriller  = 5;

}

//Usage examples:
//$monday = DayOfWeek::Monday                      // (int) 1
//DayOfWeek::isValidName('Monday')                 // (bool) true
//DayOfWeek::isValidName('monday', $strict = true) // (bool) false
//DayOfWeek::isValidValue(0)                       // (bool) true
//DayOfWeek::fromString('Monday')                  // (int) 1
//DayOfWeek::toString(DayOfWeek::Tuesday)          // (string) "Tuesday"
//DayOfWeek::toString(5)                           // (string) "Friday"