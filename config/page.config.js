var path = require('path')
var basePath = path.resolve(__dirname, '../../jiguo/protected/modules/mb/views')

function getTplPath (module) {
  return path.resolve(__dirname, `../src/pages/${module}/block_tpl/index.ejs.js`)
}

module.exports = [
  {
    name: 'article',
    main: './src/pages/article/main.js',
    options: {
      filename: path.resolve(__dirname, '../../zdm/protected/modules/admin/views/article/_editor.php'),
      template: getTplPath('article'),
			minify: {
				removeComments: true,
				collapseWhitespace: true,
				removeAttributeQuotes: false
			},
    },
    subModel: {
      UEditor: './static/UEditor/index.js'
    }
  }
]













