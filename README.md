#Mpchadwick_SearchAutocompleteConfigmarator

![](http://i.imgur.com/fDf0NLh.jpg)

Out of the box, Magento ships with search autocomplete functionality, which is great.

However, when requests come in along the lines of "How do I limit the number of results in the typeahead?" or "I want to turn off the autocomplete functionality" Magento doesn't have a great story...

Sure, it's trivial to make these kinds customizations through a local module, or editing the theme files, but wouldn't it be nice if you could configmarate all the things right from the admin panel?

Mpchadwick_SearchAutocompleteConfigmarator enhances Magento's out-of-the-box search autocomplete functionality by making several aspects of it's implementation configurable through the admin panel.

It was designed to get in the way of as little as possible and aims to only rewrite things that exist exclusively for search autocomplete.

It's purpose is to give you more control over the existing functionality without additional code deploys, and it is not intended to change the fundamental way that search autocomplete "works".

##Options

![](http://imgur.com/gEo25kp.png)

Currently, the following items can be configured through Mpchadwick_SearchAutocompleteConfigmarator.

- Enable / Disable Autocomplete
- Limit Number of Results
- Enable / Disable Display of Number of Results
- Like Match (%term% vs. %term)

These options can all be found under System > Configuration > Catalog > Catalog Search
