# Indy Fridge 🍻

This is a fun project to scratch a couple of my own itches.
The codebase generates a static site, updated each day, with
snappy search for the craft beer takeout fridge at The Independent
in Brighton, UK. https://indy-fridge.jobyharding.com

If you find yourself in Brighton and enjoy craft beer it should
be first on your list https://theindependent.pub/

This entirely my own project and is not affiliated with The Independent.
Hopefully some other Indy 'locals' will find it useful.

## For the Technically Curious

Search uses Algolia's *vanilla* JavaScript Instant Search API.
I used this project to figure out whether it was feasible to
connect Algolia with Alpine JS for an experience equivalent to
using their React API which I've used heavily in the past but
can feel unnecessarily complex.

As such, I've used an event-driven approach where `window` object is
used as an event bus to prevent tight coupling between components.

## TODO
- Add responsive can images (save these to storage)
- Add a favicon
- 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
