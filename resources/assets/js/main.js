import Vue from 'vue'

import AppComponent from './App/app.vue'

const mv = new Vue({
	el: '#app',
	components: {
		app: AppComponent
	},
	render: h => h('app'),
})