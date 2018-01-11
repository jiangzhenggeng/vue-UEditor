
var getArgv = require('./get-argv')

var arguments = getArgv
var completeModule = []
if (arguments.length) {
	config.page.forEach((item) => {
		if (completeModule.length) return
		arguments.forEach((name) => {
			if (completeModule.length) return
			if (item.name == name) {
				completeModule.push(item)
			}
		})
	})
} else {
	completeModule = config.page.filter((item) => {
		if (item.notpackage) {
			return false
		}
		return true
	})
}

if (!completeModule.length && process.argv[3] !== 'test/unit/karma.conf.js') {
	process.exit(0)
}


module.exports = getArgv
