<h1>🚩 Countdown Timer 🚩</h1>

**Tier: 1** I'm getting confortable with the challenge idea

We all have important events we look forward to in life, birthdays,
anniversaries, and holidays to name a few. Wouldn't it be nice to have an app
that counts down the months, days, hours, minutes, and seconds to an event?
Countdown Timer is just that app!

The objective of Countdown Timer is to provide a continuously decrementing
display of the he months, days, hours, minutes, and seconds to a user entered
event.

### Constraints

- Use only builtin language functions for your calculations rather than relying
on a library or package like [MomentJS](https://momentjs.com/). This assumes,
of course, that the language of your choice has adequate date and time
manipulation functions built in.
- You may not use any code generators such as the 
[Counting Down To](https://countingdownto.com/) site. You should develop your
own original implementation. 

## User Stories

-   [x] User can see an event input box containing an event name field, an
date field, an optional time, and a 'Start' button.
-   [x] User can define the event by entering its name, the date it is
scheduled to take place, and an optional time of the event. If the time is 
omitted it is assumed to be at Midnight on the event date in the local time
zone.
-   [x] User can see a warning message if the event name is blank.
-   [x] User can see a warning message if the event date or time are incorrectly
entered. 
-   [x] User can see a warning message if the time until the event data and time
that has been entered would overflow the precision of the countdown timer.
-   [x] User can click on the 'Start' button to see the countdown timer start
displaying the days, hours, minutes, and seconds until the event takes place.
-   [x] User can see the elements in the countdown timer automatically
decrement. For example, when the remaining seconds count reaches 0 the remaining
minutes count will decrement by 1 and the seconds will start to countdown from 59. This progression must take place from seconds all the way up to the remaining days position in countdown display. 

## Bonus features

-   [x] User can save the event so that it persists across sessions
-   [x] User can see an alert when the event is reached
-   [x] User can specify more than one event. 
-   [x] User can see a countdown timers for each event that has been defined.

## Example project

[Countdown Timer App](http://ofernandoavila.avilamidia.com/challenges/7-CountdownTimer/)

## Versions

[ 01/05/2023 ] - v1.0.0 - Finished project 