# ExpressionEngine JSON Importer

## Overview
Created to be able to parse huge chunks of scraped data directly into ExpressionEngine, to be able to work with the data inside the system.

## JSON Input
As of right now, the JSON needs to follow a certain convention. So you have to normalize it before parsing in.

### Convention
* JSON needs to be just the result array
* Results (as of right now) may not contain sub-arrays

### Example
	[{
		title: 'Hallo',
		favouriteDrink: 'Espresso Martini'
	},{
		title: 'Another entry',
		favouriteDrink: 'Club Mate'
	}...]

The above will work fine, as the following will not:

	[meta: {
		code: 200
	}, response: [{
		title: 'Hallo' ...
	}]]

The above won't work for it isn't a plain result array. In future versions we should probably implement this, but for now this won't work.