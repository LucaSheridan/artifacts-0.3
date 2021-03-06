
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 

Vue.component('example');

var app  = new Vue({
  el: "#app",
  
data: {
    
	rows: [

		{title: "Final Artwork", isPrimary: "1"},
	
		  ],
    
	  },
  
methods:{

	addRow: function(){
      
	this.rows.push({title:"", isPrimary: "0"});
	},

	removeRow: function(row){
      
	let index = this.rows.indexOf(row)
	this.rows.splice(index, 1);

	}
}

});