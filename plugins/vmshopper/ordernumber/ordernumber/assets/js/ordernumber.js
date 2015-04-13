var updateMessages = function(messages, area) {
    jQuery( "#system-message-container #system-message ."+area+"-message").remove();
    // Extract the messages from the returned string, add the ordernumber-message class (so the next ajax call
    // can remove them again) and then move the messages to the original message container.
    // Things are complicated by the fact that no #system-message element exists if no messages were printed so far
    var newmessages = jQuery( messages ).find("div.alert, .message").addClass(area+"-message");
    if (!jQuery( "#system-message-container #system-message").length && newmessages.length) {
        if (jQuery(newmessages).first().prop("tagName")=="dt") { // Joomla 2.x:
            jQuery( "#system-message-container" ).append( "<dl id='system-message'></div>" );
        } else {
            jQuery( "#system-message-container" ).append( "<div id='system-message'></div>" );
        }
    }
    newmessages.appendTo( "#system-message-container #system-message");
}
String.Format = function() {
  var s = arguments[0];
  for (var i = 0; i < arguments.length - 1; i++) {       
    var reg = new RegExp("\\{" + i + "\\}", "gm");             
    s = s.replace(reg, arguments[i + 1]);
  }
  return s;
}

var getCounterData = function (btn) {
    var row=jQuery(btn).parents("tr.counter_row");
    return { row: row };
}
var handleJSONResponse = function (json, counter) {
    updateMessages(json['messages'], "ordernumber");
    if (!json.authorized) {
        alert(Joomla.JText._('PLG_ORDERNUMBER_JS_NOT_AUTHORIZED', "You are not authorized to modify order number counters."));
    } else if (json.error) {
        alert(json.error);
    } else {
        // TODO: Which other error checks can we do?
    }
}
var ajaxEditCounter = function (btn, nrtype, ctr, value) {
    var counter = getCounterData(btn);
    counter.type=nrtype;
    counter.counter=ctr;
    counter.value=value;
    var value = NaN;
    var msgprefix = "";
    while (isNaN(value) && (value != null)) {
        var editprompt = Joomla.JText._('PLG_ORDERNUMBER_JS_EDITCOUNTER', "{0}Please enter the new value for the counter '{1}' (current value: {2}):");
        value = prompt (String.Format(editprompt, msgprefix, counter.counter, counter.value), counter.value);
        if (value != null)
            value = parseInt(value);
        if (isNaN(value)) 
            msgprefix = Joomla.JText._('PLG_ORDERNUMBER_JS_INVALID_COUNTERVALUE', "You entered an invalid value for the counter.\n\n");
    }
    if (value != null) {
        var loading = jQuery("img.vm-ordernumber-loading").first().clone().insertAfter(btn).show();
        jQuery.ajax({
            type: "POST",
            cache: false,
            dataType: "text", // Read text, but interpret as JSON later in the done method (prevents a warning!)
            url: "index.php?option=com_virtuemart&view=plugin&type=vmshopper&name=ordernumber&action=setCounter&format=raw",
            data: { nrtype: counter.type, counter: counter.counter, value: value },
            success: function( data ) {
                try {
                    var json = jQuery.parseJSON(data);
                    handleJSONResponse(json, counter);
                } catch (e) {
                    alert(Joomla.JText._('PLG_ORDERNUMBER_JS_JSONERROR')+"\n"+e);
                    return;
                }
                if (json.success>0) {
                    jQuery(counter.row).children(".counter_value").text(value);
                } else {
                    alert (String.Format(Joomla.JText._('PLG_ORDERNUMBER_JS_MODIFY_FAILED', "Failed modifying counter {0}"), counter.counter));
                }
            },
            error: function() { alert (String.Format(Joomla.JText._('PLG_ORDERNUMBER_JS_MODIFY_FAILED', "Failed modifying counter {0}"), counter.counter)); },
            complete: function() { jQuery(loading).remove(); },
        });
    }
}
var ajaxDeleteCounter = function (btn, nrtype, ctr, value) {
    var counter = getCounterData(btn);
    counter.type=nrtype;
    counter.counter=ctr;
    counter.value=value;
    var proceed = confirm (String.Format(Joomla.JText._('PLG_ORDERNUMBER_JS_DELETECOUNTER', "Really delete counter '{0}' with value '{1}'?"), counter.counter, counter.value));
    if (proceed == true) {
        var loading = jQuery("img.vm-ordernumber-loading").first().clone().insertAfter(btn).show();
        jQuery.ajax({
            type: "POST",
            cache: false,
            dataType: "text", // Read text, but interpret as JSON later in the done method (prevents a warning!)
            url: "index.php?option=com_virtuemart&view=plugin&type=vmshopper&name=ordernumber&action=deleteCounter&format=raw",
            data: { nrtype: counter.type, counter: counter.counter },
            success: function( data ) {
                try {
                    var json = jQuery.parseJSON(data);
                    handleJSONResponse(json, counter);
                } catch (e) {
                    alert(Joomla.JText._('PLG_ORDERNUMBER_JS_JSONERROR')+"\n"+e);
                    return;
                }
                if (json.success>0) {
                    jQuery(counter.row).fadeOut(1500, function() { jQuery(counter.row).remove(); });
                } else {
                    alert (String.Format(Joomla.JText._('PLG_ORDERNUMBER_JS_DELETE_FAILED', "Failed deleting counter {0}"), counter.counter));
                }
            },
            error: function() { alert (String.Format(Joomla.JText._('PLG_ORDERNUMBER_JS_DELETE_FAILED', "Failed deleting counter {0}"), counter.counter)); },
            complete: function() { jQuery(loading).remove(); },
        });
    }
}
var ajaxAddCounter = function (btn, nrtype) {
    var row = jQuery(btn).parents("tr.addcounter_row");
    var countername = prompt (Joomla.JText._('PLG_ORDERNUMBER_JS_NEWCOUNTER', "Please enter the format/name of the new counter:"));
    if (countername != null) {
        var loading = jQuery("img.vm-ordernumber-loading").first().clone().insertAfter(jQuery(btn).find("img.vmordernumber-counter-addbtn")).show();
        jQuery.ajax({
            type: "POST",
            cache: false,
            dataType: "text", // Read text, but interpret as JSON later in the done method (prevents a warning!)
            url: "index.php?option=com_virtuemart&view=plugin&type=vmshopper&name=ordernumber&action=addCounter&format=raw",
            data: { nrtype: nrtype, counter: countername },
            success: function( data ) {
                var json = data ? jQuery.parseJSON(data) : null;
                try {
                    var json = jQuery.parseJSON(data);
                    handleJSONResponse(json, null);
                } catch (e) {
                    alert(Joomla.JText._('PLG_ORDERNUMBER_JS_JSONERROR')+"\n"+e);
                    return;
                }
                if (json.success>0) {
                    if (json.newrow) {
                        jQuery(row).before(jQuery(json.newrow));
                    }
                } else {
                    alert (String.Format(Joomla.JText._('PLG_ORDERNUMBER_JS_ADD_FAILED', "Failed adding counter {0}"), countername));
                }
            },
            error: function() { alert (String.Format(Joomla.JText._('PLG_ORDERNUMBER_JS_ADD_FAILED', "Failed adding counter {0}"), countername)); },
            complete: function() { jQuery(loading).remove(); },
        });
    }
}
