db.results.ensureIndex( { 'meta.SERVER.REQUEST_TIME' : -1 } );
db.results.ensureIndex( { 'profile.main().wt' : -1 } );
db.results.ensureIndex( { 'profile.main().mu' : -1 } );
db.results.ensureIndex( { 'profile.main().cpu' : -1 } );
db.results.ensureIndex( { 'meta.url' : 1 } );
db.results.ensureIndex( { "meta.request_ts" : 1 }, { expireAfterSeconds : 3600 } );
