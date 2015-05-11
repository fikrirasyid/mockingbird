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
		url: mockingbird_params.api_endpoint + 'posts'
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
		render: function () {
			this.$el.html( this.template( this.model ));
			return this;
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
				}
			});
		}
	});

	// Init
	var Mockingbird = [];
	Mockingbird.header = new HeaderView();
	Mockingbird.entries = new EntriesView();
} (jQuery));