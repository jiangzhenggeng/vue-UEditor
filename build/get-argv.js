var argv = process.argv.slice()

function getArgv(option) {
	var index
	var op
	for (var i = 2; i < argv.length; i++) {
		index = argv[i].indexOf('=')
		op = argv[i].slice(0, index)
		if (op == option) {
			return argv[i].slice(index + 1) || true
		}
	}
	return false
}

module.exports = getArgv
