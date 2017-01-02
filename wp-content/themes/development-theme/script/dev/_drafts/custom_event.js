var evt = new CustomEvent('somecustomevent', { detail: 'message' });
window.dispatchEvent(evt);

window.addEventListener('somecustomevent', function (e) {
	console.log(e, e.detail);
});