const fs = require('fs-extra')

const vendors = [
  '@fortawesome/fontawesome-free/css/all.min.css',
  '@fortawesome/fontawesome-free/webfonts'
]

vendors.forEach(vendor => {
  fs.copySync(`node_modules/${vendor}`, `dist/vendor/${vendor}`)
})
