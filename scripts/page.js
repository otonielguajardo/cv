new Vue({
	el: '#page',
	data: {
		cv: {}
	},
	methods: {
		fetchCvData() {
			fetch("cv.json")
				.then(res => res.json())
				.then(data => (this.cv = data));
		},
		printPhone(phone) {
			if (!phone) return false;
			return phone.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3');
		},
		printDuration(start, end = null, format = 'MMM YYYY', humanReadable = true) {

			let startDate = moment(start).format(format);
			let endDate = end ? moment(end).format(format) : 'Presente';

			let months = end ? moment(end).diff(moment(start), 'months') : moment().diff(moment(start), 'months');
			let years = 0;

			if (months > 12) {
				years = months > 12 ? Math.floor(months / 12) : 0;
				months = months - (Math.floor(months / 12) * 12)
			}

			let time = years > 0 ? `${years} Años y ${months} Meses` : `${months} Meses`;
			let duration = humanReadable ? ` (${time})` : '';

			return `${startDate} - ${endDate}` + duration;

		}
	},
	created() {
		this.fetchCvData()
	}
});


