<a show="{refs.txtfilter.value}" ref="clearfilter" class="uk-icon-close uk-text-danger" onclick="{ clearfilter }" style="right: 0; pointer-events: all;"></a>
<div ref="quickfilterContainer" class="uk-float-left">
    <div class="uk-button uk-form-select uk-margin-small-top" data-uk-form-select show="{Object.keys(filters).length > 0}">
        <span>@lang('Quick filters')</span>
        <select ref="quickfilter" onchange="{ quickfilter }">
            <optgroup each="{group,groupname in filters}" label="{groupname}">
                <option each="{filter in group}" value="{formatQuery(filter)}">{filter.name}</option>
            </optgroup>
        </select>
    </div>
</div>
<script>
    this.collection = {{ json_encode($collection) }};
    this.filters = {{ json_encode($filters) }} || {};

    this.on("mount", function() {
        this.refs.quickfilter.value = undefined;
        this.refs.txtfilter = document.querySelector("input[ref=txtfilter]");

        this.refs.txtfilter.closest(".uk-form").append(this.refs.clearfilter);
        this.refs.txtfilter.closest(".uk-float-left").after(this.refs.quickfilterContainer);
    });

    this.quickfilter = function(e) {
        this.refs.txtfilter.value = e.target.value || "";
        e.target.value = undefined;
        triggerOnChange(this.refs.txtfilter);
    }.bind(this);


    this.clearfilter = function () {
        this.refs.txtfilter.value = "";
        triggerOnChange(this.refs.txtfilter);
    }.bind(this);

    this.getLangSuffix = function() {
        var lang = App.session.get('collections.entry.' + this.collection._id + '.lang');
        return lang ? "_" + lang : "";
    }.bind(this);

    this.formatQuery = function (filter) {
        return JSON.stringify(filter.query).replace(/\$i18n/, getLangSuffix());
    }.bind(this);

    this.triggerOnChange = function (element) {
        if ("createEvent" in document) {
            var evt = document.createEvent("HTMLEvents");
            evt.initEvent("change", false, true);
            element.dispatchEvent(evt);
        } else {
            element.fireEvent("onchange");
        }
    }
</script>