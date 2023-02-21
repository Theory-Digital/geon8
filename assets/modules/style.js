/* eslint-disable */

function uncolorMe(item){
  item.classList.remove('tw-text-primary-blue')
  item.classList.remove('tw-text-primary-yellow')
  item.classList.remove('tw-text-primary-red')
}
function colorMe(item){
  var colors = ['tw-text-primary-blue','tw-text-primary-yellow','tw-text-primary-red']
  const randomElement = colors[Math.floor(Math.random() * colors.length)];
  item.classList.add(randomElement)
}

export {uncolorMe, colorMe};