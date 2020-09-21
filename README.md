# cornhacks2020
Cornhacks 2020 Project. Authored by Chase Prochnow, Chris Galusha and Ben Galusha.

## Inspiration

Many of us have wanted to put addressable LED strips in our houses or dorm rooms, but often these devices are restricted behind clunky smartphone apps or, even worse, cheap infrared remotes with little customizability. We wanted to build a system that allows these devices to be controlled by an arbitrary client, be it Alexa, the command line, a web interface, or any other means of control.

## What it does

The Laravel server sits at the center of everything. It's capable of receiving requests over its RESTful API and forwarding those to the necessary LED strips. For this project, we build three clients: a web-based client hosted on the Laravel server itself, a command-line client and an Alexa service.

## Challenges I ran into

Initially, we wanted to use Mongoose OS to write the firmware for the LED strip. This ended up consuming a lot of time, and in the end, we opted to use the Arduino software to program the microcontroller instead.
