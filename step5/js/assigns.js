function assignYear(agno,station) {
	console.log(agno);
	console.log(station);
	window.localStorage.setItem('agno',agno);
	window.localStorage.setItem('station',station);
}