/**
 * Created by Yaroslav on 15.03.2017.
 */

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z][a-zA-Z0-9_]+[a-zA-Z0-9]$/.test(value);
});