# CollectionEntriesFilters
Cockpit (https://github.com/agentejo/cockpit) addon that adds "Quick filters" and clear filters button to the Collection entries view.

## Installation
In cockpit root directory: `git clone https://github.com/Pervanovo/CollectionEntriesFilters.git addons/CollectionEntriesFilters`

## Settings
Goto Settings > Collection entries filters to manage available quick filters.

The filter definitions json object has the following format:

```
{
  "COLLECTION_NAME": {
    "GROUP_NAME": [
      {
        "name": "NAME_OF_FILTER",
        "query": QUERY
      }
    ]
  }
}
```
`COLLECTION_NAME` The name of the collection that should have the quick filter(s)

`GROUP_NAME` The label of grouped filters

`NAME_OF_THE_FILTER` The label of the filter

`QUERY` String or object that should be used as a query for the filter.

### Localization
All instances of "$i18n" in `QUERY` will be replaced with the locale suffix (ie. "\_sv" for swedish) depending on what language is selected on the page.

### Example filter definition
```
{
  "pages": {
    "Title filters": [
      {
        "name": "Localized title is empty",
        "query": {
          "title$i18n": {
            "$regex": "^$"
          }
        }
      }
    ]
  }
}
```
