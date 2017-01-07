module.exports = Vue.directive('amajax', {

	el     : null,
	binding: null,
	vnode  : null,
	vm     : null,

	bind(el, binding, vnode) {
		let thisProps = binding.def;
		thisProps.el = el;
		thisProps.binding = binding;
		thisProps.vnode = vnode;
		thisProps.vm = vnode.context;

		el.addEventListener('submit', thisProps.onSubmit.bind(binding));

	},

	update(value) {
		console.log("updated");
	},


	// Custom Methods
	onSubmit(e) {
		e.preventDefault();
		let vm = this.def.vm,
				method = this.def.getRequestType(),
				action = this.def.getAction(),
				// @TODO: pass common data from form atts
				sendingData = dataToPost(action, {inc:'jnx', second:'sec'});

		vm.$http[method](AMdefaults.ajaxurl, sendingData)
			.then(this.def.onSuccess.bind(this.def),
				this.def.onError.bind(this.def))

	},

	// @TODO: make other checking
	onSuccess(response) {
		// console.log(JSON.parse(response.data));
		this.vm.openDialog('alertOkDialog',{
			alert : 'alertok',
			data : {
				type: 'success',
				contentHtml: 'Success',
				text: 'Ok'
			}
		})
	},

	onError(response) {
		// console.log(response.data);
		this.vm.openDialog('alertFailDialog',{
			alert : 'alertfail',
			data : {
				type: 'fail',
				contentHtml: 'Fail. Wrong request!',
				text: 'Ok'
			}
		})
	},

	getRequestType(){
		let method = this.el.querySelector('input[name="__method"]');
		return (method ? method.value: this.el.method).toLowerCase();
	},

	getAction() {
		let action = this.el.querySelector('input[name="__action"]');
		return action.value.toLowerCase();
	}


});