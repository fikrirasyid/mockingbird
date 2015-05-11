(function ($) {
	// Model
	var Header = Backbone.Model.extend();
	var Entry = Backbone.Model.extend();

	// Collection
	var HeaderCollection = Backbone.Collection.extend({
		model: Header,
		url: mockingbird_params.api_endpoint
	});

	var EntryCollection = Backbone.Collection.extend({
		model: Entry,
		url: function () {
			return mockingbird_params.api_endpoint + 'posts?page=' + parseInt( $('#entries').attr('data-page') );
		}
	});

	// View
	var HeaderView = Backbone.View.extend({
		el: $("header#header"),
		template: _.template($('#HeaderTemplate').html()),
		initialize: function () {
			this.collection = new HeaderCollection();
			this.render();
		},
		render: function () {
			var that = this;

			this.collection.fetch({
				success: function (model, response, options) {
					that.$el.html( that.template( response ) );	
				}
			})
		}
	});

	var EntryView = Backbone.View.extend({
		tagName: "article",
		className: "hentry",
		template: _.template( $("#EntryTemplate").html() ),
		templateRead: _.template( $('#ReadEntryTemplate').html() ),
		render: function () {
			this.$el.html( this.template( this.model ));
			return this;
		},
		events: {
			"click a.more-link": "readEntry",
			"click .read-entry > .modal": "closeEntry"
		},
		readEntry: function () {
			event.preventDefault();

			$('body').css({ 'overflow' : 'hidden' });

			this.$el.append( this.templateRead( this.model ) );
		},
		closeEntry: function () {
			event.preventDefault();

			var read_entry = this.$el.find( '.read-entry' );

			read_entry.addClass( 'closing' );

			read_entry.fadeOut(function(){
				$(this).remove();

				$('body').removeAttr( 'style' );
			});
		}
	});

	var EntriesView = Backbone.View.extend({
		el: $('#entries'),
		template: _.template( $('#EntryTemplate').html() ),
		tagName: "article",
		initialize: function () {
			this.collection = new EntryCollection();
			this.render();
		},
		render: function () {
			var that = this;

			this.collection.fetch({
				success: function( model, response, options) {
					_.each( response, function (entry) {
						var RenderEntryView = new EntryView({
							model: entry
						});

						that.$el.append( RenderEntryView.render().el );
					});

					// Update page count
					var next_page = parseInt( $('#entries').attr('data-page') ) + 1;
					$('#entries').attr({ 'data-page' : next_page, 'data-page-loading' : 'false' });
				}
			});
		}
	});

	// Init
	var Mockingbird = [];
	Mockingbird.header = new HeaderView();
	Mockingbird.entries = new EntriesView();

	// Pagination
	$(window).scroll(function(){
		var document_height = $(document).height();
		var window_height = $(window).height();
		var window_top_offset = $(window).scrollTop();
		var loading_point = document_height - ( window_height * 1.5 );
		var entries = $('#entries');

		if( window_top_offset > loading_point && entries.attr( 'data-page-loading') != 'true' ){
			console.log( 'habburn' );
			entries.attr({ 'data-page-loading' : 'true' });
			Mockingbird.entries = new EntriesView();	
		}
	});
} (jQuery));