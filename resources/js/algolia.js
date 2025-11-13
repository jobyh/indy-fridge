import { liteClient as algoliaSearch } from 'algoliasearch/lite'
import instantsearch from 'instantsearch.js'
import {
  connectSearchBox,
  connectInfiniteHits,
  connectRefinementList,
  connectClearRefinements,
} from 'instantsearch.js/es/connectors'
import Nprogress from 'nprogress'
import Alpine from '@alpinejs/csp'

const searchClient = algoliaSearch(
  import.meta.env.VITE_ALGOLIA_APP_ID,
  import.meta.env.VITE_ALGOLIA_SEARCH_KEY,
)

const search = instantsearch({
  indexName: 'beers-modified-desc',
  searchClient,
  future: {
    preserveSharedStateOnUnmount: true,
  },
})

const customSearchBox = connectSearchBox(
  function (renderOptions, isFirstRender) {
    const { refine } = renderOptions

    if (isFirstRender) {
      window.addEventListener('searchInput', event => {
        Nprogress.start()
        resetScroll()
        refine(event.detail.value)
      })
    }
  },
)

const customHits = connectInfiniteHits(function (renderOptions) {
  const { hits, results, isLastPage, showMore } = renderOptions

  Nprogress.done()

  window.dispatchEvent(
    new CustomEvent('searchHitsUpdated', {
      detail: {
        hits,
        totalHits: results?.nbHits,
        isLastPage,
        showMore,
      },
    }),
  )
})

const createRefinementList = facet =>
  connectRefinementList(function (renderOptions, isFirstRender) {
    const { items, refine } = renderOptions

    window.dispatchEvent(
      new CustomEvent(`${facet}FacetUpdated`, {
        detail: {
          items,
          refine,
        },
      }),
    )

    if (isFirstRender) {
      window.addEventListener(`${facet}FacetToggle`, event => {
        refine(event.detail.value)
      })

      // Remove stale favorites based on available url facet options.
      if (facet === 'url' && Alpine.store('favorites')) {
        const facets = items.map(item => item.value)
        const favorites = Alpine.store('favorites')
        favorites.items = favorites.items.filter(url => facets.includes(url))

        if (favorites.items.length === 0 && favorites.active) {
          favorites.active = false
        }
      }
    }
  })

const customClearRefinements = connectClearRefinements(
  function (renderOptions, isFirstRender) {
    const { refine } = renderOptions

    if (isFirstRender) {
      window.addEventListener('clearRefinements', event => {
        refine(event.detail.refinements)
      })
    }
  },
)

function resetScroll() {
  document.body.scrollTo(0, 0)
}

window.addEventListener('sortChanged', event => {
  resetScroll()
  search.helper.setIndex(event.detail.index).search()
})

search.addWidgets([
  customSearchBox(),
  customHits(),
  // createRefinementList('brewery')({ attribute: 'brewery', limit: 100 }),
  // createRefinementList('hops')({ attribute: 'hops', limit: 100 }),
  // createRefinementList('style')({ attribute: 'style', limit: 100 }),
  createRefinementList('url')({ attribute: 'url', limit: 1000 }),
  customClearRefinements({ includedAttributes: [] }),
])
search.start()
