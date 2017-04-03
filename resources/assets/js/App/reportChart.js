import {Bar} from 'vue-chartjs'

export default Bar.extend({
	mounted(){
		this.renderChart({
			labels : ['Jan', 'Feb', 'Mar', 'Apr'],
			dataset: [
				{
					label          : 'News reports',
					backgroundColor: '#3c8dbc',
					data           : [12, 14, 54, 13, 34, 75, 4, 41]
				}
			]
		})
	}
})
