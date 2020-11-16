import router from "~/router";

/**
 * Scroll Behavior
 *
 * @link https://router.vuejs.org/en/advanced/scroll-behavior.html
 *
 * @param  {Route} to
 * @param  {Route} from
 * @param  {Object|undefined} savedPosition
 * @return {Object}
 */
const scrollBehavior = (to, from, savedPosition) => {

  if (savedPosition)
    return savedPosition

  if (to.hash)
    return {selector: to.hash}

  const [component] = router.getMatchedComponents({...to}).slice(-1)

  if (component && component.scrollToTop === false)
    return {}

  return new Promise((resolve, reject) => {
    setTimeout(() => {
      resolve({x: 0, y: 0})
    }, 100)
  })
}


export default scrollBehavior
