# Indy Fridge 🍻

This is a fun project to scratch a couple of my own itches.
The codebase generates a static site, updated each day, with
snappy search for the craft beer takeout fridge at The Independent
in Brighton, UK. https://indy-fridge.jobyharding.com

If you find yourself in Brighton and enjoy craft beer,
[The Independent](https://theindependent.pub/) in Hanover, or
[The Rook](https://therook.pub/) its taproom in the
city centre, should be at the top of your list.

This entirely my own project and is not affiliated with The Independent.
Hopefully some other Indy 'locals' will find it useful.

## For the Technically Curious

Search uses Algolia's *vanilla* JavaScript Instant Search API.
I used this project to figure out whether it was feasible to
connect Algolia with Alpine JS for a user experience equivalent to
their React API which can feel unnecessarily complex.

As such, I've used an event-driven approach where `window` object is
used as an event bus to prevent tight coupling between components.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
