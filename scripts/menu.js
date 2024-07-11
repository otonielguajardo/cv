new Vue({
	el: '#menu',
	data: {
		themerIcon: 'moon-light',
		printerIcon: 'printer-light'
	},
	methods: {
		printPage() {
			window.print();
		},
		toggleTheme() {
			let body = document.querySelector('body');
			body.className = body.className == 'classic' ? 'dark' : 'classic';
			this.themerIcon = body.className == 'classic' ? 'moon-light' : 'sun-dark';
			this.printerIcon = body.className == 'classic' ? 'printer-light' : 'printer-dark';
		},
	},
});
