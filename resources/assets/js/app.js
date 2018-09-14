import LayoutDefault from './layout-default'
import LayoutSidebar from './layout-default'

import PageHome from './page-home'
import PageMemberList from './page-member-list'
import PageMemberCU from './page-member-cu'
import PageMemberShow from './page-member-show'
import PageProjectList from './page-project-list'
import PageProjectCU from './page-project-cu'
import PageProjectShow from './page-project-show'
import PageTaskCreate from './page-task-create'
import PageTeamList from './page-team-list'
import PageWeekList from './page-week-list'
import PageWeekCU from './page-week-cu'
import PageWeekShow from './page-week-show'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./functions');

window.Vue = require('vue');
window.Validation = require('./plugins/validation').default

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('block-record-project', require('./components/block-record-project.vue'));
Vue.component('block-record-week', require('./components/block-record-week.vue'));
Vue.component('block-record-member', require('./components/block-record-member.vue'));

const root = new Vue({
  el: '#root',
  data () {
    return {
      name: 'maianhkha',
      projects: [],
      weeks: [],
      members: [],
      tasks_create: {
        value: 0,
        tasks: []
      }
    }
  }
})

window.root = root

document.addEventListener('DOMContentLoaded', function() {

  LayoutDefault.loaded()
  LayoutSidebar.loaded()

  PageHome.loaded()
  PageMemberList.loaded()
  PageMemberCU.loaded()
  PageMemberShow.loaded()
  PageProjectList.loaded()
  PageProjectCU.loaded()
  PageProjectShow.loaded()
  PageTaskCreate.loaded()
  PageTeamList.loaded()
  PageWeekList.loaded()
  PageWeekCU.loaded()
  PageWeekShow.loaded()
})
