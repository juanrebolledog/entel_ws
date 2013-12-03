@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            Cliente REST
        </h3>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div id="rest-app">
                <div id="form-view"></div>
                <div id="result-view"></div>
            </div>
        </div>
    </div>

</section>
@stop

@section('scripts')
<script src="<?= asset('js/vendor/underscore.js'); ?>"></script>
<script src="<?= asset('js/vendor/backbone.js'); ?>"></script>
<script type="text/template" id="request-creator-tpl">
    <form action="#">
        <input type="text"/>
        <input type="text"/>
        <input type="submit"/>
    </form>
</script>
<script>
    (function($, B, _) {
        var Request = B.Model.extend({

        });

        var RequestCollection = B.Collection.extend({
            model: Request
        });

        var RequestCreatorView = B.View.extend({
            template: $('#request-creator-tpl'),
            render: function() {
                return _.template(this.template.html());
            }
        });

        var RESTClientView = B.View.extend({
            el: $('#rest-app'),
            initialize: function() {
                this.form_view = new RequestCreatorView();
                this.result_view = {};
            },
            render: function() {
                console.log(this.form_view.render());
                this.$el.find('#form-view').html(this.form_view.render());
            }
        });

        var appView = new RESTClientView();
        appView.render();
    })(jQuery, Backbone, _);
</script>
@stop