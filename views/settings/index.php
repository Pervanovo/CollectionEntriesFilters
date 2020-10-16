<div class="uk-margin-top uk-form" riot-view>
    <div>
        <ul class="uk-breadcrumb">
            <li><a href="@route('/settings')">@lang('Settings')</a></li>
            <li class="uk-active"><span>@lang('Collection entries filters')</span></li>
        </ul>
    </div>

    <div class="uk-margin">
        <label class="uk-text-small uk-text-bold">@lang('Filter definitions')</label>
        <field-object cls="uk-width-1-1" bind="filters" height="600px" allowtabs="2"></field-object>
    </div>

    <div class="uk-margin-large-top">
        <button class="uk-button uk-button-primary uk-button-large" type="button" name="button"
                onclick="{ save }">@lang('Save')
        </button>
        <a class="uk-button uk-button-large uk-button-link" href="@route('/settings')">@lang('Close')</a>
    </div>

    <script>
        riot.mixin(RiotBindMixin);

        var $this = this;

        this.filters = {{ json_encode($filters) }} || {};

        this.on('mount', function () {
            // bind clobal command + save
            Mousetrap.bindGlobal(['command+s', 'ctrl+s'], function (e) {
                e.preventDefault();
                $this.save();
                return false;
            });
        });

        this.save = function () {
            App.callmodule('collectionentriesfilters:saveFilters', this.filters).then(function() {
                App.ui.notify(App.i18n.get("Successfully saved filters!"), "success");
            }).catch(function(error) {
                App.ui.notify(JSON.stringify(error.error), "danger");
            });
        }.bind(this);
    </script>
</div>