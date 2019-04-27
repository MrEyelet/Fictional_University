import $ from 'jquery';
 
class Search {
	//1. Describe and create object
	constructor() {
		this.resultsDiv = $('#search-overlay__results');
		this.openButton = $('.js-search-trigger');
		this.closeButton = $('.search-overlay__close');
		this.searchOverlay = $('.search-overlay');
		this.isOverlayOpen = false;
		this.searchField = $('#search-terms');
		this.events();
		this.isSpinnerVisible = false;
		this.previousValue;
		this.typingTimer;
	}
	//2. Events
	events() {
		this.openButton.on('click', this.openOverlay.bind(this));
		this.closeButton.on('click', this.closeOverlay.bind(this));
		$(document).on('keydown', this.keyPressDispatcher.bind(this));
		this.searchField.on('keyup', this.typingLogic.bind(this));
	}

	//3. Methods (functions, actions)
	openOverlay() {
		this.searchOverlay.addClass('search-overlay--active');
		$('body').addClass('body-no-scroll');
		this.isOverlayOpen = true;

		// console.log('click');
		// console.log('its open');
	}

	closeOverlay() {
		this.searchOverlay.removeClass('search-overlay--active');
		$('body').removeClass('body-no-scroll');
		this.isOverlayOpen = false;
		// this.searchField.val('').blur();
		// this.resultsDiv.html('');

		// console.log('its close');
	}

	typingLogic() {

		console.log(`previous value : ${this.previousValue}`);
		console.log(`searchfield value: ${this.searchField.val()}`);

		if (this.searchField.val() != this.previousValue) {

			clearTimeout(this.typingTimer);

			if (this.searchField.val()) {

				if(!this.isSpinnerVisible) { 

				this.resultsDiv.html('<div class="spinner-loader"></div>');
				this.isSpinnerVisible = true;

			}

			this.typingTimer = setTimeout(this.getResults.bind(this), 2000);

			} else {

				this.resultsDiv.html('');
				this.isSpinnerVisible = false;

			}

		}

		this.previousValue = this.searchField.val();
	}

	getResults() {
		
		$.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
			this.resultsDiv.html(`
				<h2 class="search-overlay__section-title">General information</h2>
				${posts.length ? '<ul class="link-list min-list">' : '<p>No searching results</p>'}
					${posts.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
				${posts.length ? '</ul>' : '' }
			`);
			this.isSpinnerVisible = false;                                                    
		});

	}

	keyPressDispatcher(e) {

		// console.log(e.keyCode);

		if(e.keyCode == 83 && !this.isOverlayOpen && !$('input, textarea').is(':focus')) {

			// console.log(e.keyCode);
			
			this.openOverlay();

		} else if(e.keyCode == 27 && this.isOverlayOpen) {

			// console.log(e.keyCode);

			this.closeOverlay();

		}
	}
}

export default Search;