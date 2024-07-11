new Vue({
	el: '#page',
	data: {
		cv: {
			jobs: [],
			tools: [],
		}
	},
	methods: {
		fetchCvData() {
			fetch("cv.json")
				.then(res => res.json())
				.then(data => {
					
					let pmTools = data.tools
						.filter((tool) => tool.type == 1);
					
					let devTools = data.tools
						.filter((tool) => tool.type == 2);

					let tools = [...pmTools, ...devTools];

					// shows all jobs, and only 3 tasks for first 2 jobs
					let jobs = data.jobs.map((job, index) => {
						let description = index <= 3 ? job.description : null;
						
						let tasks = [];
						if (index == 0) tasks = job.tasks.slice(0, 4);
						if (index == 1) tasks = job.tasks.slice(0, 3);
						
						return {
							...job,
							description,
							tasks
						}
					});
					
					this.cv = {
						...data,
						tools,
						jobs
					};
				});
		},
		printPhone(phone) {
			if (!phone) return false;
			return phone.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3');
		},
		printDuration(start, end = null, includeMonths = true) {
			let startDate = new Date(start);
			let endDate = end ? new Date(end) : new Date();

			let totalMonths = (endDate.getFullYear() - startDate.getFullYear()) * 12 + (endDate.getMonth() - startDate.getMonth());
			let years = Math.floor(totalMonths / 12);
			let months = totalMonths % 12;

			let duration = `${months} meses`;

			if (years > 0) {
				if (years == 1) {
					duration = `${years} año`;
				} else {
					duration = `${years} años`;
				}

				if (includeMonths && months > 1) {
					duration += ` y ${months} meses`;
				}
			}

			return duration;
		},
		printDate(date, options = { year: 'numeric', month: 'short' }) {
			let endDate = date ? new Date(date).toLocaleDateString('es-ES', options) : 'Presente';
			
			return endDate;
		},
		printDateRange(start, end = null, options = { year: 'numeric', month: 'short' }) {
			let startDate = new Date(start).toLocaleDateString('es-ES', options);
			let endDate = end ? new Date(end).toLocaleDateString('es-ES', options) : 'Presente';

			return `${startDate} - ${endDate}`;
		},
		randomizeArray(arr) {
			arr.sort(() => Math.random() - 0.5);
			return arr;
		}
	},
	created() {
		this.fetchCvData()
	}
});