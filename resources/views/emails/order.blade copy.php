<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>Email templ</title>
    <!--[if (mso 16)]>
      <style type="text/css">
         a {text-decoration: none;}
      </style>
      <![endif]-->
    <!--[if gte mso 9]>
      <style>sup { font-size: 100% !important; }</style>
      <![endif]-->
    <!--[if gte mso 9]>
      <xml>
         <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
         </o:OfficeDocumentSettings>
      </xml>
      <![endif]-->
    <!--[if !mso]>-->
    
    <!--<![endif]-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&amp;display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@600&amp;display=swap');
        @import url('https://fonts.googleapis.com/css?family=Arvo:400,400i,700,700i|Lato:400,400i,700,700i|Lora:400,400i,700,700i|Merriweather:400,400i,700,700i|Merriweather Sans:400,400i,700,700i|Noticia Text:400,400i,700,700i|Open Sans:400,400i,700,700i|Playfair Display:400,400i,700,700i|Roboto:400,400i,700,700i|Source Sans Pro:400,400i,700,700i');
        /* this fix for ckeditor jumping scroll, when a user adds a lot of new lines */
        html,
        body {
            height: auto !important;
            overflow-x: visible !important;
        }

        div.cke_focus:focus {
            outline: 0px none currentColor !important;
            outline-offset: 0px !important;
        }

        [class^="es-icon-"] {
            font-size: 12px;
        }

        .esd-stripe {
            text-align: center;
            margin-left: 2px;
            margin-right: 2px;
        }

        .esd-drag-structure .esd-stripe .esd-structure:not(.esd-extension-internal-block),
        .esd-drag-stripe .esd-stripe {
            box-shadow: 0px 1px 0 #8ab7ec inset;
        }

        .esd-drag-structure [class*="esd-block-"],
        .esd-drag [class*="esd-block-"],
        .esd-drag-amp-form-container [class*="esd-block-"],
        .esd-drag-stripe .esd-stripe>table {
            opacity: 0.4;
        }

        .esd-frame.esd-hover.esd-activated,
        .esd-frame.esd-active {
            position: relative;
            border-collapse: separate;
            display: table-cell;
            /*border-radius: 1px;*/
        }

        .esd-stripe.esd-hover.esd-activated:not(.esd-dynamic-element),
        .esd-stripe.esd-active:not(.esd-dynamic-element),
        .esd-stripe-draggable-target,
        .esd-structure.esd-hover.esd-activated:not(.esd-dynamic-element),
        .esd-structure.esd-active:not(.esd-dynamic-element) {
            display: block !important;
        }

        .esd-srt .esd-stripe.esd-frame.esd-hover.esd-activated {
            box-shadow: none;
            outline: none;
        }

        .esd-frame.esd-hover.esd-activated,
        .esd-frame-element.esd-hover-element:hover,
        .esd-stripe-draggable-target {
            /*box-shadow: 0px 0px 0px 2px #b3b3b3;*/
            outline: 2px solid #b3b3b3;
        }

        [esd-dynamic-block] .esd-frame-element.esd-hover-element:hover {
            box-shadow: none !important;
            outline: none !important;
        }

        .esd-frame.esd-active,
        .esd-frame-element.esd-active {
            /*box-shadow: 0px 0px 0px 2px #666666 !important;*/
            outline: 2px solid #666666 !important;
        }

        .esd-block-spacer .esd-spacer-resizer {
            font-size: 16px;
            line-height: initial;
            position: absolute;
            display: inline-block;
            background: #666666;
            color: #ffffff;
            left: 50%;
            padding: 4px 5px 5px 8px;
            border-radius: 19px;
            bottom: 0;
            margin-bottom: -13px;
            margin-left: -32px;
            cursor: ns-resize;
            display: none;
        }

        .esd-activated .esd-add-stripe {
            background: #b3b3b3;
        }

        .esd-active .esd-add-stripe,
        .esd-activated .esd-add-stripe:hover {
            background: #666666;
        }

        .esd-add-stripe {
            background: #666666;
            width: 40px;
            border-radius: 20px;
            position: absolute;
            left: 0;
            bottom: -21px;
            height: 40px;
            margin-left: 10px;
            z-index: 99999;
        }

        .esd-stripe.esd-align-left>.esd-structure-type,
        .esd-stripe.esd-align-left .esd-add-stripe {
            right: 0;
            left: auto;
        }

        .esd-align-left .esd-container-frame>.esd-block-btn>div {
            float: left !important;
        }

        .esd-align-left .esdev-amp-form-container>.esd-block-btn>div:last-child>a,
        .esd-align-left .esd-container-frame>.esd-block-btn>div:last-child>a {
            border-radius: 0px 20px 20px 0px !important;
            padding-left: 9px;
            padding-right: 11px;
        }

        .esd-align-left .esdev-amp-form-container>.esd-block-btn>div.esd-more>a,
        .esd-align-left .esd-container-frame>.esd-block-btn>div.esd-more>a {
            padding-left: 10px;
            padding-right: 9px;
        }

        .esd-align-left .esdev-amp-form-container.esd-hover>.esd-block-btn,
        .esd-align-left .esdev-amp-form-container.esd-active>.esd-block-btn,
        .esd-align-left .esd-container-frame.esd-hover>.esd-block-btn,
        .esd-align-left .esd-container-frame.esd-active>.esd-block-btn {
            right: auto !important;
            border-radius: 0 20px 20px 0px !important;
            margin-left: -1px;
            z-index: 99999;
        }

        .esd-align-right.esd-stripe.esd-hover>.esd-block-btn,
        .esd-align-right.esd-stripe.esd-active>.esd-block-btn {
            left: 0;
            right: auto;
            margin-left: -1px;
            border-radius: 0 20px 20px 0;
        }

        .esd-align-right.esd-stripe>.esd-block-btn>div {
            float: left !important;
        }

        .esd-align-right.esd-stripe>.esd-block-btn>div:last-child>a {
            border-radius: 0px 20px 20px 0px !important;
            padding-left: 9px;
            padding-right: 11px;
        }

        .esd-align-right.esd-stripe>.esd-block-btn>div.esd-more>a {
            padding-left: 10px;
            padding-right: 9px;
        }

        .esd-align-right .esd-structure.esd-hover>.esd-block-btn,
        .esd-align-right .esd-structure.esd-active>.esd-block-btn,
        .esd-align-right .esd-block.esd-hover>.esd-block-btn,
        .esd-align-right .esd-block.esd-active>.esd-block-btn {
            right: 0;
            left: auto;
            width: auto;
            border-radius: 20px 0 0 20px;
        }

        .esd-align-right .esd-structure>.esd-block-btn>div,
        .esd-align-right .esd-block>.esd-block-btn>div {
            float: right !important;
        }

        .esd-align-right .esd-structure>.esd-block-btn>div:last-child>a,
        .esd-align-right .esd-block>.esd-block-btn>div:last-child>a {
            border-radius: 20px 0px 0px 20px !important;
            padding-right: 9px;
            padding-left: 10px;
        }

        .esd-structure-type {
            float: left;
            background: #b3b3b3;
            display: inline-block;
            position: absolute;
            left: 0;
            top: -19px;
            padding: 3px 5px;
            color: #ffffff;
            font-size: 11px;
            border-radius: 8px 8px 0px 0px;
            cursor: default;
            height: 12px;
            line-height: normal;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: calc(100% - 10px);
            overflow: hidden;
        }

        .esd-hidden-element,
        .esd-mime-element,
        .esd-sync-element,
        [esd-custom-display-condition] {
            /*box-shadow: 0px 0px 0px 2px rgba(238, 162, 54, 0.8);*/
            outline: 2px solid rgba(238, 162, 54, 0.8);
            position: relative;
            border-radius: 1px;
        }

        .esd-conditional-block-label {
            right: 30px;
            background: rgba(238, 162, 54, 0.8);
            top: 0px;
            border-radius: 0px 0px 8px 8px;
            padding: 2px 6px 4px;
            position: absolute;
            color: #ffffff;
            font-size: 11px;
            cursor: default;
            height: 12px;
            line-height: normal;
            z-index: 9999999;
        }

        .esd-conditions-hover-popup {
            z-index: 9999999;
        }

        .esd-conditions-hover-popup .es-icon-edit,
        .esd-conditions-hover-popup .es-icon-delete {
            cursor: pointer;
        }

        .esd-hidden-status {
            right: 0;
            background: rgba(238, 162, 54, 0.8);
            top: 0px;
            border-radius: 0px 0px 0px 8px;
            padding: 2px 6px 4px;
            position: absolute;
            color: #ffffff;
            font-size: 11px;
            cursor: default;
            height: 12px;
            line-height: normal;
            z-index: 1000;
        }

        .esd-mime-type {
            left: 0;
            background: rgba(238, 162, 54, 0.8);
            top: 0px;
            border-radius: 0px 0px 8px 0px;
            padding: 2px 6px 4px;
            position: absolute;
            color: #ffffff;
            font-size: 11px !important;
            cursor: default;
            height: 12px;
            line-height: normal;
            z-index: 999;
            margin-top: 0 !important;
        }

        .esd-sync-module {
            right: 0;
            background: rgba(238, 162, 54, 0.8);
            bottom: 0px;
            border-radius: 8px 0px 0px 0px;
            padding: 4px 6px 3px;
            position: absolute;
            color: #ffffff;
            font-size: 11px;
            cursor: default;
            height: 12px;
            line-height: normal;
            z-index: 10000;
        }

        .esd-structure-type .es-icon-cog,
        .esd-hidden-status .es-icon-eye-hide,
        .esd-hidden-status .es-icon-hide-on-desktop,
        .esd-hidden-status .es-icon-hide-on-mobile,
        .esd-mime-type .es-icon-amp,
        .esd-sync-module .es-icon-sync,
        .esd-structure-type .es-icon-condition,
        .esd-conditional-block-label .es-icon-condition {
            font-size: 7px;
        }

        .esd-structure-type .es-icon-cog:before,
        .esd-mime-type .es-icon-amp:before,
        .esd-sync-module .es-icon-sync:before,
        .esd-structure-type .es-icon-condition:before {
            top: 0;
        }

        .esdev-amp-form-container>.esd-structure-type,
        .esd-frame.esdev-amp-form-container.esd-active>.esd-structure-type,
        .esd-container-frame>.esd-structure-type,
        .esd-frame.esd-container-frame.esd-active>.esd-structure-type {
            background: #ffffff;
            left: auto;
            right: 0;
            border: 1px solid #8ab7ec;
            color: #8ab7ec;
            top: -20px;
            height: 12px;
        }

        .esd-add-stripe-button-animation {
            transform: rotate(45deg);
            transition: all 0.2s ease-in-out;
        }

        .esd-add-stripe>a {
            color: #fff;
            padding: 11px 9px 15px;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
            width: 20px;
            transition: all 0.2s ease-in-out;
        }

        .esd-frame:before,
        .esd-frame:after {
            content: " ";
            display: table;
        }

        .esd-frame:after {
            clear: both;
        }

        .esd-active {
            z-index: 9999;
        }

        .esdev-amp-form-container.esd-hover.esd-activated,
        .esdev-amp-form-container.esd-active,
        .esd-drag .esdev-amp-form-container,
        .esd-frame.esd-container-frame.esd-hover.esd-activated,
        .esd-frame.esd-container-frame.esd-active,
        .esd-drag .esd-container-frame:not(.esd-extension-internal-block),
        .esd-drag .esd-insideblock-dropzone.ui-droppable-active,
        .esd-drag .esd-amp-accordion,
        .esd-drag-amp-form-container .esd-amp-form {
            /*box-shadow: 0 0 0 1px #8AB7EC !important;*/
            outline: 1px solid #8ab7ec !important;
        }

        .esd-frame.esd-container-frame.esd-hover.esd-activated>.esd-block-btn,
        .esd-frame.esd-container-frame.esd-active>.esd-block-btn,
        .esd-frame.esdev-amp-form-container.esd-hover.esd-activated>.esd-block-btn,
        .esd-frame.esdev-amp-form-container.esd-active>.esd-block-btn {
            background: #fff;
            border: 1px solid #8ab7ec;
            left: auto;
            display: block;
            right: 100%;
            border-radius: 20px 2px 2px 20px;
            margin-top: -22px;
        }

        .esd-container-frame>.esd-block-btn>div,
        .esdev-amp-form-container>.esd-block-btn>div,
        .esd-stripe>.esd-block-btn>div,
        .esdev-amp-form-container .esd-structure-type,
        .esd-container-frame .esd-structure-type {
            float: right !important;
        }

        .esd-frame.esd-container-frame>.esd-block-btn a,
        .esd-frame.esdev-amp-form-container>.esd-block-btn a,
        .esd-block-icons a {
            color: #8ab7ec !important;
        }

        .esd-empty-container .esd-block-icons {
            opacity: 0;
            transition: all 0.2s ease-in-out;
            margin-top: -24px;
            display: block;
            height: 24px;
        }

        .esd-empty-container:hover .esd-block-icons {
            opacity: 1;
            margin-top: 0px;
            height: auto;
        }

        .esd-empty-container .esd-block-icons a:hover {
            opacity: 1;
            color: #8ab7ec !important;
        }

        .esd-empty-container .esd-block-icons a {
            opacity: 0.4;
            cursor: pointer;
        }

        .esd-empty-container .es-icon-drop-here,
        .esd-empty-container .esd-block-icons a {
            padding: 4px;
            display: inline-block;
        }

        .esd-block-btn>div>a {
            color: #ffffff;
            padding: 12px 9px 15px;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
            width: 20px;
        }

        .esd-block-btn>div>a:hover {
            background: rgba(0, 0, 0, 0.2);
            color: #ffffff !important;
        }

        .esd-container-frame>.esd-block-btn>div>a:hover,
        .esdev-amp-form-container>.esd-block-btn>div>a:hover {
            background: rgba(138, 183, 236, 0.2);
            color: #8ab7ec !important;
        }

        .esd-block-btn>div:last-child>a {
            border-radius: 0px 20px 20px 0px;
            padding-right: 11px;
        }

        .esdev-amp-form-container>.esd-block-btn>div:last-child>a,
        .esdev-amp-form-container>.esd-block-btn>div.esd-more>a,
        .esd-container-frame>.esd-block-btn>div:last-child>a,
        .esd-container-frame>.esd-block-btn>div.esd-more>a {
            padding-left: 12px;
            padding-right: 8px;
        }

        .esd-stripe>.esd-block-btn>div:last-child>a {
            border-radius: 20px 0px 0px 20px;
            padding-left: 11px;
        }

        .esd-block-btn>div.esd-more>a:hover {
            background: none;
        }

        .esd-stripe>.esd-block-btn>div.esd-more>a {
            padding-left: 12px;
            padding-right: 8px;
        }

        .esd-block-btn>div:nth-of-type(2)>a {
            margin-left: 2px;
        }

        .esd-block-btn.esd-activated>div:nth-of-type(2),
        .esd-block-btn>.esd-more {
            margin-left: -2px;
        }

        .esd-block-btn.esd-activated>div,
        .esd-block-btn-hover>div {
            display: inline-block;
            float: left;
        }

        .esd-block-btn.esd-activated,
        .esd-block-btn-hover {
            width: 116px;
            z-index: 99999;
        }

        .esd-hover.esd-activated {
            z-index: 9999;
        }

        .esd-stripe.esd-hover.esd-activated {
            z-index: unset;
        }

        .esd-container-frame>.esd-block-btn.esd-activated,
        .esd-structure>.esd-block-btn.esd-activated,
        .esd-block-btn-hover {
            width: 154px;
        }

        .esdev-amp-form-container>.esd-block-btn.esd-activated {
            width: 40px;
        }

        .esd-block-amp-form-submit>.esd-block-btn.esd-activated {
            width: 40px;
        }

        .esd-srt {
            overflow-y: hidden;
        }

        .esd-srt .esd-container-frame .esd-copy,
        .esd-srt .esd-container-frame .esd-save,
        .esd-srt .esd-structure .esd-save {
            display: none;
        }

        .esd-srt .esd-container-frame>.esd-block-btn.esd-activated {
            width: 78px;
        }

        .esd-srt .esd-structure>.esd-block-btn.esd-activated {
            width: 117px;
        }

        .esd-container-frame>.esd-block-btn.esd-activated.esd-no-block-library,
        .esd-structure>.esd-block-btn.esd-activated.esd-no-block-library,
        .esd-block-btn-hover .esd-no-block-library {
            width: 117px;
        }

        .esd-container-frame>.esd-block-btn.esd-activated.esd-no-block-library.esd-conditions-button-visible,
        .esd-structure>.esd-block-btn.esd-activated.esd-no-block-library.esd-conditions-button-visible,
        .esd-block-btn-hover .esd-no-block-library.esd-conditions-button-visible {
            width: 155px;
        }

        .esd-container-frame>.esd-block-btn.esd-activated.esd-conditions-button-visible,
        .esd-structure>.esd-block-btn.esd-activated.esd-conditions-button-visible,
        .esd-block-btn-hover .esd-conditions-button-visible {
            width: 195px;
        }

        .esd-frame>.esd-block-btn {
            left: 100%;
            position: absolute;
            background: rgba(0, 0, 0, 0.3);
            color: #ffffff;
            display: none;
            z-index: 99999;
            margin-left: 2px;
            top: 50%;
            margin-top: -21px;
            border-radius: 1px 20px 20px 1px;
        }

        .esd-frame>.esd-block-btn.esd-activated,
        .esd-frame.esd-active>.esd-block-btn,
        .esd-frame.esd-active>.esd-structure-type,
        .esd-block.esd-active .esd-structure-type.active {
            background: #666666;
        }

        .esd-block .esd-hover.esd-activated {
            z-index: 999999;
        }

        .esd-container-frame>.esd-block-btn>div:last-child>a,
        .esdev-amp-form-container>.esd-block-btn>div:last-child>a {
            border-radius: 20px 0px 0px 20px;
        }

        .esd-stripe.esd-hover>.esd-block-btn,
        .esd-stripe.esd-active>.esd-block-btn {
            right: 0;
            left: auto;
            width: auto;
            border-radius: 20px 0 0 20px;
        }

        .esd-hover.esd-activated>.esd-block-btn,
        .esd-active>.esd-block-btn,
        .esd-block-spacer:hover .esd-spacer-resizer,
        .esd-block-spacer.esd-active .esd-spacer-resizer,
        .esd-stripe.esd-active .esd-add-stripe,
        .esd-stripe.esd-hover.esd-activated .esd-add-stripe,
        .esd-stripe.esd-hover.esd-activated>.esd-structure-type,
        .esd-stripe.esd-active>.esd-structure-type,
        .esd-structure.esd-hover.esd-activated>.esd-structure-type,
        .esd-structure.esd-active>.esd-structure-type,
        .esd-container-frame.esd-hover.esd-activated>.esd-structure-type,
        .esd-container-frame.esd-active>.esd-structure-type,
        .esdev-amp-form-container.esd-active>.esd-structure-type,
        .esdev-amp-form-container.esd-hover.esd-activated>.esd-structure-type,
        .esd-extension.esd-hover.esd-activated>.esd-structure-type,
        .esd-extension.esd-active>.esd-structure-type,
        .esd-block.esd-active .esd-structure-type {
            display: block;
        }

        .esd-ai-structure-type {
            position: absolute;
            transform: translateX(-50%);
            left: 50%;
            top: 0;
        }

        .esd-ai-structure-type .esd-structure-type {
            position: relative;
            float: left;
            cursor: pointer;
        }

        .esd-move,
        .esd-delete,
        .esd-copy,
        .esd-conditions,
        .esd-add-stripe,
        .esd-spacer-resizer,
        .esd-save,
        .esd-block-btn.esd-activated>.esd-more,
        .esd-block-btn-hover>.esd-more,
        .esd-structure-type,
        .fake-cke-text,
        .esd-hide {
            display: none;
        }

        .esd-placement {
            box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.8);
            position: relative;
            z-index: 9999;
        }

        .esd-placement-dark {
            box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.8);
        }

        .esd-plc-label {
            background: rgba(0, 0, 0, 1);
            color: #ffffff;
            position: absolute;
            left: 50%;
            margin-left: -53px;
            font-size: 12px;
            text-align: center;
            padding: 3px;
            margin-top: -10px;
            border-radius: 18px;
            min-width: 100px;
            white-space: nowrap;
        }

        .esd-placement-dark .esd-plc-label {
            background: rgba(255, 255, 255, 1);
            color: black;
        }

        .esd-empty-container .esd-plc-label {
            margin-top: -3px;
        }

        .esd-empty-container,
        .esd-block-spacer .esd-spacer-resizer,
        .esd-structure-type,
        .esd-plc-label,
        .esd-dynamic-element *,
        .esd-mime-type,
        .esd-sync-module {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
        }

        .cke_button__mergetags_label {
            display: inline !important;
        }

        .cke_button__mergetags_icon {
            display: none !important;
        }

        a.cke_button,
        a.cke_combo_button {
            border-radius: 5px;
        }

        .esd-empty-container {
            background: #ecf3fc;
            height: 100px;
            border: 1px dashed #8ab7ec;
            font-size: 12px;
            color: #8ab7ec;
            text-align: center;
            cursor: default;
        }

        .esd-dynamic-element {
            height: 200px;
            padding: 10px 0;
            border-radius: 1px;
            color: #d6a447;
            cursor: default;
            background-color: #f2edc9;
            /*box-shadow: 0px 0px 0px 1px #eae2a9;*/
            outline: 1px solid #eae2a9;
            text-align: center;
            vertical-align: middle;
        }

        .esd-dynamic-element .esd-container-text {
            padding-top: 10px;
            font-size: 12px;
            text-align: center;
            cursor: default;
            display: inline-block;
        }

        .esd-dynamic-title {
            font-size: 14px;
            color: #ce9325;
            margin-bottom: 20px;
        }

        .esd-empty-container .esd-container-text {
            display: block;
            margin-top: 5px;
            padding: 0px 3px;
        }

        .esd-empty-column {
            height: 100px;
            border: 1px dashed #b9d4f4;
            font-size: 12px;
            color: #a7c8f1;
            text-align: center;
        }

        .esd-empty-container .esd-empty-container {
            border: 1px dashed rgba(138, 183, 236, 0.44);
        }

        .esd-frame.esdev-amp-form-container.esd-empty-container.esd-hover.esd-activated,
        .esd-frame.esd-container-frame.esd-empty-container.esd-hover.esd-activated {
            border: 0px solid transparent;
            border-bottom: 2px solid transparent;
        }

        .esd-drop {
            box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 0.6);
            position: relative;
        }

        .col-xs-3,
        .col-xs-4,
        .col-xs-6,
        .col-xs-8,
        .col-xs-12 {
            position: relative;
            min-height: 1px;
        }

        .col-xs-3,
        .col-xs-4,
        .col-xs-6,
        .col-xs-8,
        .col-xs-12 {
            float: left;
        }

        .col-xs-12 {
            width: 100%;
        }

        .col-xs-8 {
            width: 66.66666667%;
        }

        .col-xs-6 {
            width: 50%;
        }

        .col-xs-4 {
            width: 33.33333333%;
        }

        .col-xs-3 {
            width: 25%;
        }

        .esd-stripe-preview {
            width: 168px !important;
            padding: 10px 5px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 10px;
            height: 32px !important;
        }

        .esd-structure-preview {
            background: #ecf3fc;
            height: 30px;
            border: 1px dashed #8ab7ec;
            color: #8ab7ec;
            padding: 0 10px;
            display: block;
            margin: 0 5px;
            border-radius: 2px;
        }

        .esd-header-popover .esd-stripes-popover {
            margin-top: -45px !important;
        }

        .esd-footer-popover .esd-stripes-popover,
        .es-content.esd-header-popover .esd-stripes-popover {
            bottom: -4px !important;
        }

        .esd-header-popover .esd-stripes-popover::before,
        .esd-header-popover .esd-stripes-popover::after {
            top: 23px !important;
        }

        .esd-footer-popover .esd-stripes-popover::before,
        .es-content.esd-header-popover .esd-stripes-popover::before {
            top: 100% !important;
            margin-top: -35px !important;
        }

        .esd-footer-popover .esd-stripes-popover::after,
        .es-content.esd-header-popover .esd-stripes-popover::after {
            top: 100% !important;
            margin-top: -33px !important;
        }

        .esd-stripes-popover .esd-stripe-preview {
            float: left;
            margin-right: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: border 0.2s ease-in-out;
        }

        .esd-align-left .esd-stripes-popover {
            left: auto;
            right: 0;
            margin-left: 0;
            margin-right: 50px;
        }

        .esd-align-left .esd-stripes-popover::before {
            border-right: 12px solid transparent;
            border-left: 12px solid rgba(0, 0, 0, 0.15);
            right: -24px;
            margin-top: -12px;
        }

        .esd-align-left .esd-stripes-popover::after {
            border-right: 10px solid transparent;
            border-left: 10px solid #f6f6f6;
            right: -20px;
            margin-top: -10px;
        }

        .esd-stripes-popover {
            width: 585px;
            position: absolute;
            left: 0;
            margin-left: 50px;
            background: #f6f6f6;
            padding: 15px 0px 0px 15px;
            border-radius: 17px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
            margin-top: -99px;
            z-index: 99999;
            transition: all 0.2s ease-in-out;
        }

        .esd-hidden-right {
            opacity: 0;
            visibility: hidden;
            left: 20px;
            transition: all 0.2s ease-in-out;
        }

        .esd-stripes-popover .esd-stripe-preview:hover {
            border: 1px solid #31cb4b;
            transition: all 0.2s ease-in-out;
            box-shadow: 0px 0px 0px 1px #31cb4b;
        }

        .esd-stripes-popover::after {
            border-left: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 10px solid #f6f6f6;
            border-top: 10px solid transparent;
            top: 50%;
            content: "";
            right: 100%;
            position: absolute;
            margin-top: -10px;
        }

        .esd-stripes-popover::before {
            border-left: 12px solid transparent;
            border-bottom: 12px solid transparent;
            border-right: 12px solid rgba(0, 0, 0, 0.15);
            border-top: 12px solid transparent;
            top: 50%;
            content: "";
            right: 100%;
            position: absolute;
            margin-top: -12px;
        }

        .cke_button__emplelink_icon {
            background-image: url("minimalist/icons.png?t=H956") !important;
        }

        .cke_button__emojione_icon {
            background-image: url("../img/emojione.png") !important;
        }

        .cke_button__textFormatMenu_icon,
        .cke_button__insertMenu_icon {
            background-image: url("../img/cke-more.png") !important;
            background-position: 0 0px;
            background-size: 16px;
        }

        .cke_button__textformatmenu .cke_button_arrow,
        .cke_button__insertmenu .cke_button_arrow {
            display: none;
        }

        .cke_combo__mergetags .cke_combo_text {
            width: auto;
        }

        .cke_ltr.cke_hidpi .cke_button__emplelink_icon {
            background-image: url("minimalist/icons_hidpi.png?t=H956") !important;
        }

        .cke_ltr.cke_hidpi .cke_button__emplelink_icon,
        .cke_button__emplelink_icon {
            background-position: 0 -1320px !important;
            background-size: 16px !important;
        }

        .cke_unlink_icon {
            background-position: 0 -1344px !important;
        }

        .esd-block-image img[src*="default-img"],
        .esd-block-carousel img[src*="default-img"],
        .esd-block-amp-carousel img[src*="default-img"] {
            background: #f9f9f9 url("../img/default-img-back.png") no-repeat 50%;
            box-shadow: 0px 0px 0px 1px #eeeeee inset;
        }

        .esd-block-menu img[src*="default-img"],
        .esd-block-button img[src*="default-img"],
        .esd-block-social img[src*="default-img"] {
            background: transparent url("../img/default-menu-back.png") no-repeat 50%;
        }

        .esd-block-video img[src*="default-img"] {
            background: #f9f9f9 url("../img/default-video-back.png") no-repeat 50%;
            box-shadow: 0px 0px 0px 1px #eeeeee inset;
        }

        .esd-block-banner img[src*="default-img"] {
            background: #f9f9f9 url("../img/default-banner-back.png") no-repeat 50%;
            box-shadow: 0px 0px 0px 1px #eeeeee inset;
        }

        .esd-block-timer img[src*="default-img"] {
            background: #f9f9f9 url("../img/default-timer-back.png") no-repeat 50%;
            box-shadow: 0px 0px 0px 1px #eeeeee inset;
        }

        .esd-srt .esd-email-paddings {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .esd-email-paddings {
            padding-top: 46px;
            padding-bottom: 25px;
        }

        .esd-email-paddings-increased {
            padding-top: 89px !important;
        }

        .esd-block-social a>img {
            cursor: default;
        }

        .esd-move-border img {
            box-shadow: -2px 0px 0px 0px rgba(0, 0, 0, 0.8);
        }

        .esdev-disable-select {
            -webkit-touch-callout: none;
            /* iOS Safari */
            -webkit-user-select: none;
            /* Safari */
            -khtml-user-select: none;
            /* Konqueror HTML */
            -moz-user-select: none;
            /* Firefox */
            -ms-user-select: none;
            /* Internet Explorer/Edge */
            user-select: none;
            /* Non-prefixed version, currently
                supported by Chrome and Opera */
        }

        .esdev-enable-select {
            -webkit-user-select: text;
            /* Chrome 49+ */
            -moz-user-select: text;
            /* Firefox 43+ */
            -ms-user-select: text;
            /* No support yet */
            user-select: text;
            /* Likely future */
        }

        .esd-block-social>table {
            display: inline-block;
        }

        [disabled] {
            cursor: not-allowed !important;
        }

        *[disabled] * {
            opacity: 0.7;
            pointer-events: none;
        }

        @media only screen and (max-width: 600px) {

            .esd-frame.esd-hover.esd-activated,
            .esd-frame.esd-active {
                display: table-cell;
            }

            .esd-stripes-popover {
                width: 195px !important;
                margin-top: -237px !important;
            }
        }

        @media only screen and (max-width: 794px) {
            .esd-email-paddings {
                padding-top: 0px;
            }
        }

        @media only screen and (max-width: 1020px) {

            .esd-hover>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library),
            .esd-active>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library) {
                right: 0;
                left: auto;
                width: auto;
                border-radius: 20px 0 0 20px;
            }

            .esd-container-frame.esd-hover>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library),
            .esd-container-frame.esd-active>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library) {
                right: auto !important;
                border-radius: 0 20px 20px 0px !important;
                margin-left: -1px;
            }

            .esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library)>div:last-child>a {
                border-radius: 20px 0px 0px 20px !important;
                padding-right: 9px;
                padding-left: 10px;
            }

            .esd-container-frame>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library)>div:last-child>a {
                border-radius: 0px 20px 20px 0px !important;
                padding-left: 9px;
                padding-right: 11px;
            }

            .esd-container-frame>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library)>div {
                float: left !important;
            }

            .esd-structure>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library)>div,
            .esd-block>.esd-block-btn.esd-conditions-button-visible:not(.esd-no-block-library)>div {
                float: right !important;
            }
        }

        @media only screen and (max-width: 920px) {

            .esd-hover>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library,
            .esd-active>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library {
                right: 0;
                left: auto;
                width: auto;
                border-radius: 20px 0 0 20px;
            }

            .esd-container-frame.esd-hover>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library,
            .esd-container-frame.esd-active>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library {
                right: auto !important;
                border-radius: 0 20px 20px 0px !important;
                margin-left: -1px;
            }

            .esd-block-btn.esd-conditions-button-visible.esd-no-block-library>div:last-child>a {
                border-radius: 20px 0px 0px 20px !important;
                padding-right: 9px;
                padding-left: 10px;
            }

            .esd-container-frame>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library>div:last-child>a {
                border-radius: 0px 20px 20px 0px !important;
                padding-left: 9px;
                padding-right: 11px;
            }

            .esd-container-frame>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library>div {
                float: left !important;
            }

            .esd-structure>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library>div,
            .esd-block>.esd-block-btn.esd-conditions-button-visible.esd-no-block-library>div {
                float: right !important;
            }
        }

        @media only screen and (max-width: 865px) {
            .esd-stripes-popover {
                width: 390px;
                margin-top: -133px;
            }

            .esd-hover>.esd-block-btn,
            .esd-active>.esd-block-btn {
                right: 0;
                left: auto;
                width: auto;
                border-radius: 20px 0 0 20px;
            }

            .esd-block-btn>div.esd-more>a {
                padding-left: 12px;
                padding-right: 8px;
            }

            .esdev-amp-form-container.esd-hover>.esd-block-btn,
            .esdev-amp-form-container.esd-active>.esd-block-btn,
            .esd-container-frame.esd-hover>.esd-block-btn,
            .esd-container-frame.esd-active>.esd-block-btn {
                right: auto !important;
                border-radius: 0 20px 20px 0px !important;
                margin-left: -1px;
                z-index: 99999;
            }

            .esd-container-frame>.esd-block-btn>div {
                float: left !important;
            }

            .esd-structure>.esd-block-btn>div,
            .esd-block>.esd-block-btn>div {
                float: right !important;
            }

            .esd-block-btn>div:last-child>a {
                border-radius: 20px 0px 0px 20px !important;
                padding-right: 9px;
                padding-left: 10px;
            }

            .esdev-amp-form-container>.esd-block-btn>div:last-child>a,
            .esd-container-frame>.esd-block-btn>div:last-child>a {
                border-radius: 0px 20px 20px 0px !important;
                padding-left: 9px;
                padding-right: 11px;
            }

            .esdev-amp-form-container>.esd-block-btn>div.esd-more>a,
            .esd-container-frame>.esd-block-btn>div.esd-more>a {
                padding-left: 10px;
                padding-right: 9px;
            }
        }

        .loader-c {
            width: 100%;
            height: 20px;
            text-align: center;
        }

        .loader-z {
            width: 20px;
            height: 20px;
            margin: 0 auto;
            border-radius: 50%;
            border-top-color: transparent;
            border-left-color: transparent;
            border-right-color: transparent;
            box-shadow: 1px 1px 0px rgb(49, 203, 75);
            animation: cssload-spin 690ms infinite linear;
            -o-animation: cssload-spin 690ms infinite linear;
            -ms-animation: cssload-spin 690ms infinite linear;
            -webkit-animation: cssload-spin 690ms infinite linear;
            -moz-animation: cssload-spin 690ms infinite linear;
        }

        @keyframes cssload-spin {
            100% {
                transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes cssload-spin {
            100% {
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-ms-keyframes cssload-spin {
            100% {
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-webkit-keyframes cssload-spin {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes cssload-spin {
            100% {
                -moz-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        /*---------------------- FIX TO HIDE DEV BLOCKS WIHT NO CONTENT --- START ----------------------------*/
        .esd-empty-container {
            display: table-cell !important;
        }

        .esdev-empty-img,
        .esdev-empty-video {
            display: block !important;
        }

        /*---------------------- FIX TO HIDE DEV BLOCKS WIHT NO CONTENT --- END ----------------------------*/

        /*---------------------- ICONS----------------------------*/
        @font-face {
            font-family: "fontello";
            src: url("../fonts/es-icon-mail-preview.eot?112");
            src: url("../fonts/es-icon-mail-preview.eot?112#iefix") format("embedded-opentype"),
                url("../fonts/es-icon-mail-preview.woff2?112") format("woff2"),
                url("../fonts/es-icon-mail-preview.woff?112") format("woff"),
                url("../fonts/es-icon-mail-preview.ttf?112") format("truetype"),
                url("../fonts/es-icon-mail-preview.svg?112#es-icon-mail-preview") format("svg");
            font-weight: normal;
            font-style: normal;
        }

        [class^="es-icon-"]:before,
        [class*=" es-icon-"]:before {
            font-family: "fontello";
            font-style: normal;
            font-weight: normal;
            speak: none;
            display: inline-block;
            text-decoration: inherit;
            width: 0.9em;
            margin-right: 0.1em;
            text-align: center;
            font-variant: normal;
            text-transform: none;
            line-height: 0.8em;
            top: 2px;
            position: relative;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-size: 166%;
        }

        .es-icon-text:before {
            content: "\e90f";
        }

        /* 'î¤' */
        .es-icon-button:before {
            content: "\e911";
        }

        /* 'î¤‘' */
        .es-icon-image:before {
            content: "\e914";
        }

        /* 'î¤”' */
        .es-icon-plus:before {
            content: "\e915";
        }

        /* 'î¤•' */
        .es-icon-devider:before {
            content: "\e917";
        }

        /* 'î¤—' */
        .es-icon-delete:before {
            content: "\e91a";
        }

        /* 'î¤š' */
        .es-icon-move:before {
            content: "\e921";
        }

        /* 'î¤¡' */
        .es-icon-cog:before {
            content: "\e922";
        }

        /* 'î¤¢' */
        .es-icon-copy:before {
            content: "\e923";
        }

        /* 'î¤£' */
        .es-icon-edit:before {
            content: "\e91c";
        }

        /* 'î¤œ' */
        .es-icon-save:before {
            content: "\e924";
        }

        /* 'î¤¤' */
        .es-icon-dot-3:before {
            content: "\e925";
        }

        /* 'î¤¥' */
        .es-icon-eye-hide:before {
            content: "\e92d";
        }

        /* 'î¤­' */
        .es-icon-drop-here:before {
            content: "\e968";
        }

        /* 'î¥¨' */
        .es-icon-double-click:before {
            content: "\ea04";
        }

        /* 'î¨„' */
        .es-icon-amp:before {
            content: "\ea0d";
        }

        /* 'î¨' */
        .es-icon-condition:before {
            content: "\ea1f";
        }

        /* 'î¨Ÿ' */
        .es-icon-hide-on-desktop:before {
            content: "\ea3f";
        }

        /* 'î¨¿' */
        .es-icon-hide-on-mobile:before {
            content: "\ea4f";
        }

        /* 'î©' */
        .es-icon-sync:before {
            content: "\ea8a";
        }

        /* 'îªŠ' */
        .es-icon-edit:before {
            content: "\e91c";
        }

        /* 'î¤œ' */

        .caption-area {
            position: absolute !important;
            z-index: 20;
            border: 2px dashed #31cb4b;
        }

        .disabled-cke-toolbar {
            opacity: 0.5;
            cursor: not-allowed !important;
            pointer-events: none;
        }

        .caption-wrapper {
            position: absolute !important;
            border: 2px solid transparent;
            padding: 2px;
            overflow: hidden;
            z-index: 10;
            display: block !important;
        }

        .caption-wrapper span {
            line-height: 150%;
        }

        .esd-banner-interactive .caption-wrapper p {
            line-height: 150%;
        }

        .caption-wrapper:hover,
        .caption-wrapper.esd-banner-caption-activated {
            border: 2px solid #31cb4b !important;
        }

        .caption-wrapper.non-active:after {
            content: " ";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            cursor: move;
        }

        .caption-wrapper:hover>.ui-resizable-e:after,
        .caption-wrapper:hover>.ui-resizable-w:after {
            content: " ";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 10px;
            width: 10px;
            background: #31cb4b;
            z-index: 100;
        }

        .caption-wrapper>.caption>p {
            color: white;
        }

        .esd-banner-generating {
            background-color: rgba(0, 0, 0, 0.3);
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 15;
        }

        .esd-banner-additional-picture {
            position: absolute !important;
            top: 10px;
            left: 10px;
            z-index: 5;
            border: 2px solid transparent;
            cursor: move !important;
        }

        .esd-banner-additional-picture:hover>.ui-resizable-handle {
            background: #31cb4b;
        }

        .esd-banner-additional-picture:hover {
            border: 2px solid #31cb4b !important;
        }

        .esd-sticky-zone {
            border: 2px solid transparent;
            position: absolute;
        }

        .esd-hovered-sticky-zone {
            border: 2px solid #31cb4b !important;
        }

        .esd-hint-sticky-zone {
            border: 2px dashed #31cb4b;
        }

        .esd-banner-background {
            cursor: default !important;
        }

        esd-config-block,
        esd-stored-config-block {
            display: none !important;
        }

        #cke-toolbar-container,
        .banner-toolbar {
            position: fixed;
            top: 0;
            /*bottom: 0;*/
            left: 0;
            width: 100%;
            z-index: 9999;
        }

        .banner-toolbar>.cke {
            visibility: inherit;
        }

        #banner-cke-toolbar-container .cke_top {
            padding: 0;
        }

        #cke-toolbar-container .cke_toolbox,
        .banner-toolbar .cke_toolbox {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cke_chrome {
            border: none !important;
        }

        .cke_top {
            border-bottom: 1px solid #dddddd !important;
            background: #e6e6e6 !important;
        }

        .cke_combo__fontsize>.cke_combo_button>.cke_combo_text,
        .cke_combo__lineheight>.cke_combo_button>.cke_combo_text {
            width: 20px;
        }

        .cke_combo__font>.cke_combo_button>.cke_combo_text {
            width: 60px;
        }

        .esd-banner-add-text-backdrop::before {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            content: "";
            z-index: 100;
            cursor: crosshair;
        }

        .cke_button__mergetag_icon,
        .cke_button__linewrap_icon {
            background-image: url("../img/cke-icons/icons.png?t=H957") !important;
        }

        .cke_ltr.cke_hidpi .cke_button__mergetag_icon,
        .cke_ltr.cke_hidpi .cke_button__linewrap_icon {
            background-image: url("../img/cke-icons/icons_hidpi.png?t=H957") !important;
        }

        .cke_ltr.cke_hidpi .cke_button__linewrap_icon,
        .cke_button__linewrap_icon {
            background-position: 0 -2330px !important;
            background-size: 16px !important;
        }

        .cke_ltr.cke_hidpi .cke_button__mergetag_icon,
        .cke_button__mergetag_icon {
            background-position: 0 -2404px !important;
            background-size: 16px !important;
            width: 16px;
            padding: 0;
        }

        .cke_lineUnwrap_icon {
            background-position: 0 -2355px !important;
            width: 16px;
            padding: 0;
        }

        [contenteditable]:focus {
            outline: 0px solid transparent;
        }

        .esd-disable-editing {
            pointer-events: none;
        }

        .esd-text-only .esd-block-text,
        .esd-text-only .esd-block-image,
        .esd-text-only .esd-block-timer,
        .esd-text-only .esd-block-button,
        .esd-text-only .esd-block-banner,
        .esd-text-only .esd-block-video,
        .esd-text-only .esd-block-menu,
        .esd-text-only .esd-block-social,
        .esd-text-only .esd-block-amp-carousel,
        .esd-text-only .caption-wrapper>.caption {
            pointer-events: all;
        }

        .esd-text-only .caption-wrapper,
        .esd-text-only .esd-block-btn {
            pointer-events: none;
        }

        .esd-text-only .cke_toolbox .cke_button,
        .esd-text-only .cke_toolbox .cke_combo_button {
            opacity: 0.6;
        }

        .cke_combopanel__format {
            width: 200px;
        }

        .cke_combopanel {
            max-height: 268px;
        }

        .cke_ltr.cke_panel:not(.cke_menu_panel) {
            min-height: 235px;
        }

        .cke_ltr.cke_panel.cke_combopanel__lineheight {
            min-height: 202px;
        }

        /* --- amp form --- */
        .esd-hidden-field-label {
            font-size: 10px;
            padding: 2px;
            border-radius: 4px;
            float: right;
        }

        .esd-block-amp-form-input-hidden {
            padding: 3px 3px 3px;
            border-radius: 6px;
            background: #efefef;
        }

        input[type="text"][readonly] {
            background: #efefef;
        }

        /* --- amp form end --- */

        /*This will work for firefox*/
        @-moz-document url-prefix() {

            .esd-frame.esd-structure .es-left,
            .esd-frame.esd-structure .es-right {
                display: block;
            }
        }

        .esd-srt-zone {
            box-shadow: 0px 0px 0px 1px #8ab7ec;
            z-index: 99999999;
        }

        .esd-srt-or-label {
            background: #ffffff;
            right: calc(50% - 20px);
            border: 1px solid #8ab7ec;
            color: #8ab7ec;
            top: calc(100% - 10px);
            position: absolute;
            padding: 3px 5px;
            font-size: 11px;
            border-radius: 8px;
            cursor: default;
            height: 12px;
            line-height: normal;
            width: 40px;
            z-index: 99999999;
            text-align: center;
        }

        .esd-merge-tag {
            line-height: normal;
            padding: 2px 2px 2px 7px;
            display: inline;
            border-radius: 5px;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1) inset;
            margin-right: 2px;
            margin-left: 2px;
        }

        .esd-x {
            color: #333333;
            display: inline-block;
            padding: 0px 5px 0 8px;
            height: 20px;
            cursor: pointer;
        }

        [dir="rtl"] .esd-merge-tag {
            padding-right: 7px;
            padding-left: 2px;
        }

        [dir="rtl"] .esd-x {
            padding: 0px 8px 0 5px;
        }

        .esd-drag-blocks-available .esd-draggable.esd-block {
            cursor: move;
        }


        /* CONFIG STYLES Please do not delete and edit CSS styles below */
        /* IMPORTANT THIS STYLES MUST BE ON FINAL EMAIL */
        #outlook a {
            padding: 0;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        .es-button-border:hover a.es-button,
        .es-button-border:hover button.es-button {
            background: #f6c936 !important;
        }

        .es-button-border:hover {
            border-color: #42d159 #42d159 #42d159 #42d159 !important;
            background: #f6c936 !important;
        }

        td .es-button-border:hover a.es-button-1668779391109 {
            background: #efefef !important;
            border-color: #efefef !important;
            color: #666666 !important;
        }

        td .es-button-border-1668779507891:hover {
            background: #efefef !important;
        }

        td .es-button-border:hover a.es-button-1668779338591 {
            background: #ffffff !important;
            border-color: #ffffff !important;
        }

        td .es-button-border-1668779648071:hover {
            background: #ffffff !important;
            border-color: #f6c936 #f6c936 #f6c936 #f6c936 !important;
        }

        td .es-button-border:hover a.es-button-1668779684347 {
            background: #ffffff !important;
            border-color: #ffffff !important;
        }

        td .es-button-border-1668779684347:hover {
            background: #ffffff !important;
            border-color: #f6c936 #f6c936 #f6c936 #f6c936 !important;
        }

        td .es-button-border:hover a.es-button-1668780931339 {
            background: #ffffff !important;
            border-color: #ffffff !important;
        }

        td .es-button-border-1668780931339:hover {
            background: #ffffff !important;
            border-color: #f6c936 #f6c936 #f6c936 #f6c936 !important;
        }

        td .es-button-border:hover a.es-button-1668781425309 {
            background: #ffffff !important;
            border-color: #ffffff !important;
        }

        td .es-button-border-1668781425309:hover {
            background: #ffffff !important;
            border-color: #f6c936 #f6c936 #f6c936 #f6c936 !important;
        }

        /*
                END OF IMPORTANT
                */
        body {
            width: 100%;
            font-family: Nunito, Roboto, sans-serif;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse;
            border-spacing: 0px;
        }

        table td,
        body,
        .es-wrapper {
            padding: 0;
            Margin: 0;
        }

        .es-content,
        .es-header,
        .es-footer {
            table-layout: fixed !important;
            width: 100%;
        }

        img {
            display: block;
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p,
        hr {
            Margin: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            Margin: 0;
            line-height: 120%;
            mso-line-height-rule: exactly;
            font-family: 'Fredoka One', helvetica, arial, sans-serif;
        }

        p,
        ul li,
        ol li,
        a {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
            mso-line-height-rule: exactly;
        }

        .es-left {
            float: left;
        }

        .es-right {
            float: right;
        }

        .es-p5 {
            padding: 5px;
        }

        .es-p5t {
            padding-top: 5px;
        }

        .es-p5b {
            padding-bottom: 5px;
        }

        .es-p5l {
            padding-left: 5px;
        }

        .es-p5r {
            padding-right: 5px;
        }

        .es-p10 {
            padding: 10px;
        }

        .es-p10t {
            padding-top: 10px;
        }

        .es-p10b {
            padding-bottom: 10px;
        }

        .es-p10l {
            padding-left: 10px;
        }

        .es-p10r {
            padding-right: 10px;
        }

        .es-p15 {
            padding: 15px;
        }

        .es-p15t {
            padding-top: 15px;
        }

        .es-p15b {
            padding-bottom: 15px;
        }

        .es-p15l {
            padding-left: 15px;
        }

        .es-p15r {
            padding-right: 15px;
        }

        .es-p20 {
            padding: 20px;
        }

        .es-p20t {
            padding-top: 20px;
        }

        .es-p20b {
            padding-bottom: 20px;
        }

        .es-p20l {
            padding-left: 20px;
        }

        .es-p20r {
            padding-right: 20px;
        }

        .es-p25 {
            padding: 25px;
        }

        .es-p25t {
            padding-top: 25px;
        }

        .es-p25b {
            padding-bottom: 25px;
        }

        .es-p25l {
            padding-left: 25px;
        }

        .es-p25r {
            padding-right: 25px;
        }

        .es-p30 {
            padding: 30px;
        }

        .es-p30t {
            padding-top: 30px;
        }

        .es-p30b {
            padding-bottom: 30px;
        }

        .es-p30l {
            padding-left: 30px;
        }

        .es-p30r {
            padding-right: 30px;
        }

        .es-p35 {
            padding: 35px;
        }

        .es-p35t {
            padding-top: 35px;
        }

        .es-p35b {
            padding-bottom: 35px;
        }

        .es-p35l {
            padding-left: 35px;
        }

        .es-p35r {
            padding-right: 35px;
        }

        .es-p40 {
            padding: 40px;
        }

        .es-p40t {
            padding-top: 40px;
        }

        .es-p40b {
            padding-bottom: 40px;
        }

        .es-p40l {
            padding-left: 40px;
        }

        .es-p40r {
            padding-right: 40px;
        }

        .es-menu td {
            border: 0;
        }

        .es-menu td a img {
            display: inline-block !important;
            vertical-align: middle;
        }

        /*
                END CONFIG STYLES
                */
        s {
            text-decoration: line-through;
        }

        p,
        ul li,
        ol li {
            font-family: Nunito, Roboto, sans-serif;
            line-height: 150%;
        }

        ul li,
        ol li {
            Margin-bottom: 15px;
            margin-left: 0;
        }

        a {
            text-decoration: underline;
        }

        .es-menu td a {
            text-decoration: none;
            display: block;
            font-family: Nunito, Roboto, sans-serif;
        }

        .es-wrapper {
            width: 100%;
            height: 100%;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-wrapper-color,
        .es-wrapper {
            background-color: #f5f5f5;
        }

        .es-header {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-header-body {
            background-color: #ffffff;
        }

        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li {
            color: #0f181a;
            font-size: 12px;
        }

        .es-header-body a {
            color: #0f181a;
            font-size: 12px;
        }

        .es-content-body {
            background-color: #ffffff;
        }

        .es-content-body p,
        .es-content-body ul li,
        .es-content-body ol li {
            color: #0f181a;
            font-size: 14px;
        }

        .es-content-body a {
            color: #f1ba0a;
            font-size: 14px;
        }

        .es-footer {
            background-color: transparent;
            background-image: ;
            background-repeat: repeat;
            background-position: center top;
        }

        .es-footer-body {
            background-color: #0f181a;
        }

        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li {
            color: #ffffff;
            font-size: 14px;
        }

        .es-footer-body a {
            color: #ffffff;
            font-size: 14px;
        }

        .es-infoblock,
        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li {
            line-height: 120%;
            font-size: 12px;
            color: #cccccc;
        }

        .es-infoblock a {
            font-size: 12px;
            color: #cccccc;
        }

        h1 {
            font-size: 44px;
            font-style: normal;
            font-weight: normal;
            color: #0f181a;
        }

        h2 {
            font-size: 32px;
            font-style: normal;
            font-weight: normal;
            color: #0f181a;
        }

        h3 {
            font-size: 20px;
            font-style: normal;
            font-weight: normal;
            color: #0f181a;
        }

        .es-header-body h1 a,
        .es-content-body h1 a,
        .es-footer-body h1 a {
            font-size: 44px;
        }

        .es-header-body h2 a,
        .es-content-body h2 a,
        .es-footer-body h2 a {
            font-size: 32px;
        }

        .es-header-body h3 a,
        .es-content-body h3 a,
        .es-footer-body h3 a {
            font-size: 20px;
        }

        a.es-button,
        button.es-button {
            padding: 10px 30px 10px 30px;
            display: inline-block;
            background: #f1ba0a;
            border-radius: 30px;
            font-size: 16px;
            font-family: Nunito, Roboto, sans-serif;
            font-weight: bold;
            font-style: normal;
            line-height: 120%;
            color: #0F181A;
            text-decoration: none;
            width: auto;
            text-align: center;
            mso-padding-alt: 0;
            mso-border-alt: 10px solid #f1ba0a;
        }

        .es-button-border {
            border-style: solid solid solid solid;
            border-color: #2cb543 #2cb543 #2cb543 #2cb543;
            background: #f1ba0a;
            border-width: 0px 0px 0px 0px;
            display: inline-block;
            border-radius: 30px;
            width: auto;
        }

        .msohide {
            mso-hide: all;
        }

        .es-button img {
            display: inline-block;
            vertical-align: middle;
        }

        /* RESPONSIVE STYLES Please do not delete and edit CSS styles below. If you don't need responsive layout, please delete this section. */
        @media only screen and (max-width: 600px) {

            p,
            ul li,
            ol li,
            a {
                line-height: 150% !important;
            }

            h1,
            h2,
            h3,
            h1 a,
            h2 a,
            h3 a {
                line-height: 120%;
            }

            h1 {
                font-size: 30px !important;
                text-align: left !important;
            }

            h2 {
                font-size: 24px !important;
                text-align: left !important;
            }

            h3 {
                font-size: 20px !important;
                text-align: left !important;
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 30px !important;
                text-align: left !important;
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 24px !important;
                text-align: left !important;
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px !important;
                text-align: left !important;
            }

            .es-menu td a {
                font-size: 14px !important;
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 14px !important;
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li,
            .es-content-body a {
                font-size: 14px !important;
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 14px !important;
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important;
            }

            *[class="gmail-fix"] {
                display: none !important;
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important;
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important;
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important;
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important;
            }

            .es-button-border {
                display: inline-block !important;
            }

            a.es-button,
            button.es-button {
                font-size: 16px !important;
                display: inline-block !important;
            }

            .es-adaptive table,
            .es-left,
            .es-right {
                width: 100% !important;
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important;
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important;
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important;
            }

            .es-m-p0 {
                padding: 0 !important;
            }

            .es-m-p0r {
                padding-right: 0 !important;
            }

            .es-m-p0l {
                padding-left: 0 !important;
            }

            .es-m-p0t {
                padding-top: 0 !important;
            }

            .es-m-p0b {
                padding-bottom: 0 !important;
            }

            .es-m-p20b {
                padding-bottom: 20px !important;
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important;
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important;
            }

            tr.es-desk-hidden {
                display: table-row !important;
            }

            table.es-desk-hidden {
                display: table !important;
            }

            td.es-desk-menu-hidden {
                display: table-cell !important;
            }

            .es-menu td {
                width: 1% !important;
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important;
            }

            table.es-social {
                display: inline-block !important;
            }

            table.es-social td {
                display: inline-block !important;
            }

            .es-desk-hidden {
                display: table-row !important;
                width: auto !important;
                overflow: visible !important;
                max-height: inherit !important;
            }

            .es-m-p5 {
                padding: 5px !important;
            }

            .es-m-p5t {
                padding-top: 5px !important;
            }

            .es-m-p5b {
                padding-bottom: 5px !important;
            }

            .es-m-p5r {
                padding-right: 5px !important;
            }

            .es-m-p5l {
                padding-left: 5px !important;
            }

            .es-m-p10 {
                padding: 10px !important;
            }

            .es-m-p10t {
                padding-top: 10px !important;
            }

            .es-m-p10b {
                padding-bottom: 10px !important;
            }

            .es-m-p10r {
                padding-right: 10px !important;
            }

            .es-m-p10l {
                padding-left: 10px !important;
            }

            .es-m-p15 {
                padding: 15px !important;
            }

            .es-m-p15t {
                padding-top: 15px !important;
            }

            .es-m-p15b {
                padding-bottom: 15px !important;
            }

            .es-m-p15r {
                padding-right: 15px !important;
            }

            .es-m-p15l {
                padding-left: 15px !important;
            }

            .es-m-p20 {
                padding: 20px !important;
            }

            .es-m-p20t {
                padding-top: 20px !important;
            }

            .es-m-p20r {
                padding-right: 20px !important;
            }

            .es-m-p20l {
                padding-left: 20px !important;
            }

            .es-m-p25 {
                padding: 25px !important;
            }

            .es-m-p25t {
                padding-top: 25px !important;
            }

            .es-m-p25b {
                padding-bottom: 25px !important;
            }

            .es-m-p25r {
                padding-right: 25px !important;
            }

            .es-m-p25l {
                padding-left: 25px !important;
            }

            .es-m-p30 {
                padding: 30px !important;
            }

            .es-m-p30t {
                padding-top: 30px !important;
            }

            .es-m-p30b {
                padding-bottom: 30px !important;
            }

            .es-m-p30r {
                padding-right: 30px !important;
            }

            .es-m-p30l {
                padding-left: 30px !important;
            }

            .es-m-p35 {
                padding: 35px !important;
            }

            .es-m-p35t {
                padding-top: 35px !important;
            }

            .es-m-p35b {
                padding-bottom: 35px !important;
            }

            .es-m-p35r {
                padding-right: 35px !important;
            }

            .es-m-p35l {
                padding-left: 35px !important;
            }

            .es-m-p40 {
                padding: 40px !important;
            }

            .es-m-p40t {
                padding-top: 40px !important;
            }

            .es-m-p40b {
                padding-bottom: 40px !important;
            }

            .es-m-p40r {
                padding-right: 40px !important;
            }

            .es-m-p40l {
                padding-left: 40px !important;
            }
        }

        /* END RESPONSIVE STYLES */
        html,
        body {
            font-family: arial, 'helvetica neue', helvetica, sans-serif;
        }
    </style>
</head>
@php
    $shippingAddress = null;
    try{
        $shippingAddress = unserialize($order->shipping_details);
    }catch(Exception $e){
        $shippingAddress = null;
    }
@endphp
<body data-new-gr-c-s-loaded="14.1088.0">
    <div class="es-wrapper-color">
        <!--[if gte mso 9]>
         <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
            <v:fill type="tile" color="#f5f5f5"></v:fill>
         </v:background>
         <![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings ui-droppable" valign="top">
                        <table cellpadding="0" cellspacing="0" class="esd-header-popover es-header ui-draggable"
                            align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-hover" align="center"
                                        esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                            Header
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content ui-draggable" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-activated" align="center"
                                        esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                            Content
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="es-content-body" style="background-color: #ffffff;" width="600"
                                            cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                            <tbody class="ui-droppable">
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure es-p30t es-p40b es-p20l es-m-p20r esd-frame esdev-disable-select esd-hover"
                                                        align="left" esdev-eq="false" esd-custom-block-id="820638"
                                                        esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            Structure
                                                        </div>
                                                        <div class="esd-block-btn
                                                ">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <!--[if mso]>
                                             <table width="580" cellpadding="0" cellspacing="0">
                                                <tr>
                                                   <td width="580" valign="top">
                                                      <![endif]-->
                                                        <table cellspacing="0" cellpadding="0" align="left"
                                                            class="es-left">
                                                            <tbody>
                                                                <tr class="esd-mobile-hidden"></tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                   </td>
                                                   <td width="undefined" valign="top">
                                                      <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left" width="100%">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="580" align="left"
                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                                     ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-image esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        style="font-size: 0px;"
                                                                                        esd-handler-name="imgBlockHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                </tr>
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p20t es-m-p30t es-m-txt-c esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h1>Order Confirmed!</h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p15t es-p15b es-p20r es-p20l esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <p>We did our best to give
                                                                                            you<br>Thanks for your order
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                   </td>
                                                   <td width="5"></td>
                                                   <td width="undefined" valign="top">
                                                      <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right"
                                                            align="right">
                                                            <tbody>
                                                                <tr class="esd-mobile-hidden"></tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                   </td>
                                                </tr>
                                             </table>
                                             <![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content ui-draggable" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-hover" align="center"
                                        esd-custom-block-id="820640" esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                            Content
                                        </div>
                                        <div class="esd-block-btn">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0" width="600" style="background-color: #fafafa;">
                                            <tbody class="ui-droppable">
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure es-p20 esd-frame esd-hover esdev-disable-select"
                                                        align="left" esd-custom-block-id="820639"
                                                        esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            Structure
                                                        </div>
                                                        <div class="esd-block-btn
                                                ">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="560"
                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                        align="center" valign="top"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                            ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p10t es-m-txt-c esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                        esd-no-block-library
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h2>Order #{{$order->order_no}}</h2>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                        @foreach($order->items as $ik => $item)
                                            @php
                                                $cutOptions = $prodDetails = [];
                                                if(!empty($item->product_details)){
                                                    try{
                                                        $expandPD = unserialize($item->product_details);
                                                        $prodDetails = $expandPD;
                                                        try{
                                                            $cutOptions = $expandPD['cut_options'] ? unserialize($expandPD['cut_options']) : [];
                                                        }catch(Exception $e){
                                                            $cutOptions = [];
                                                        }
                                                    }catch(Exception $e){
                                                        $cutOptions = $prodDetails = [];
                                                    }
                                                }
                                            @endphp
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure {{ count($order->items)==1 ? 'es-p20' : 'es-p20t' }} es-p20r es-p20l esdev-adapt-off esd-frame esd-hover esdev-disable-select"
                                                        align="left"
                                                        esd-dynamic-block="{&quot;link&quot;:{&quot;blockMapping&quot;:[{&quot;selector&quot;:&quot;a&quot;,&quot;attribute&quot;:&quot;href&quot;}]},&quot;variables&quot;:[{&quot;variable&quot;:&quot;p_image&quot;,&quot;name&quot;:&quot;Image&quot;,&quot;blockMapping&quot;:[{&quot;selector&quot;:&quot;.p_image&quot;,&quot;attribute&quot;:&quot;src&quot;}],&quot;externalMapping&quot;:{&quot;pageSelector&quot;:{&quot;selector&quot;:&quot;&quot;},&quot;modifier&quot;:{&quot;regexs&quot;:[]}}},{&quot;variable&quot;:&quot;p_name&quot;,&quot;name&quot;:&quot;Name&quot;,&quot;blockMapping&quot;:[{&quot;selector&quot;:&quot;.p_name&quot;}],&quot;externalMapping&quot;:{&quot;pageSelector&quot;:{&quot;selector&quot;:&quot;&quot;},&quot;modifier&quot;:{&quot;regexs&quot;:[]}}},{&quot;variable&quot;:&quot;p_description&quot;,&quot;name&quot;:&quot;Description&quot;,&quot;blockMapping&quot;:[{&quot;selector&quot;:&quot;.p_description&quot;}],&quot;externalMapping&quot;:{&quot;pageSelector&quot;:{&quot;selector&quot;:&quot;&quot;},&quot;modifier&quot;:{&quot;regexs&quot;:[]}}},{&quot;variable&quot;:&quot;p_price&quot;,&quot;name&quot;:&quot;Price&quot;,&quot;blockMapping&quot;:[{&quot;selector&quot;:&quot;.p_price&quot;}],&quot;externalMapping&quot;:{&quot;pageSelector&quot;:{&quot;selector&quot;:&quot;&quot;},&quot;modifier&quot;:{&quot;regexs&quot;:[]}}}]}"
                                                        esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            <span class="es-icon-cog"></span> Smart-Structure
                                                        </div>
                                                        <div class="esd-block-btn">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <table width="560" cellpadding="0" cellspacing="0"
                                                            class="esdev-mso-table">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-left" align="left">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td width="174"
                                                                                        class="es-m-p0r esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                                        align="center"
                                                                                        esd-handler-name="containerHandler">
                                                                                        <div class="esd-structure-type">
                                                                                            Container
                                                                                        </div>
                                                                                        <div class="esd-block-btn
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-save"
                                                                                                title="Save as module">
                                                                                                <a><span
                                                                                                        class="es-icon-save"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody class="ui-droppable">
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="center"
                                                                                                        class="esd-block-image esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        style="font-size: 0px;"
                                                                                                        esd-handler-name="imgBlockHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <a
                                                                                                            href="javascript:(0);"><img
                                                                                                                class="adapt-img p_image"
                                                                                                                src="{{ Storage::url($prodDetails['image']) }}"
                                                                                                                alt=""
                                                                                                                style="display: block; border-radius: 20px;"
                                                                                                                width="174"></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-left" align="left">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td width="173"
                                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                                        align="center"
                                                                                        esd-handler-name="containerHandler">
                                                                                        <div class="esd-structure-type">
                                                                                            Container
                                                                                        </div>
                                                                                        <div class="esd-block-btn
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-save"
                                                                                                title="Save as module">
                                                                                                <a><span
                                                                                                        class="es-icon-save"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody class="ui-droppable">
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="left"
                                                                                                        class="esd-block-text es-p15b esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <h3
                                                                                                            class="p_name">
                                                                                                            {{ $item->product->name }}</h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="left"
                                                                                                        class="esd-block-text esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <p
                                                                                                            class="p_description">
                                                                                                           Quantity : {{ $item->quantity }}</p>

                                                                                                           <p class="p_description">
                                                                                                            Cut Options :
                                                                                                            {{ implode(',',$cutOptions) }}
                                                                                                           </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-right" align="right">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td width="173" align="center"
                                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                                        esd-handler-name="containerHandler">
                                                                                        <div class="esd-structure-type">
                                                                                            Container
                                                                                        </div>
                                                                                        <div class="esd-block-btn
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-save"
                                                                                                title="Save as module">
                                                                                                <a><span
                                                                                                        class="es-icon-save"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody class="ui-droppable">
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-m-txt-r esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <h3><b
                                                                                                                class="p_price">${{ $item->total_price }}</b>
                                                                                                        </h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content ui-draggable" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-hover" align="center"
                                        esd-custom-block-id="820641" esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                            Content
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0" width="600">
                                            <tbody class="ui-droppable">
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure es-p20t es-p20r es-p20l esdev-adapt-off esd-frame esdev-disable-select esd-hover"
                                                        align="left" esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            Structure
                                                        </div>
                                                        <div class="esd-block-btn
                                                ">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <table width="560" cellpadding="0" cellspacing="0"
                                                            class="esdev-mso-table">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-left" align="left">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td width="429"
                                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                                        align="left"
                                                                                        esd-handler-name="containerHandler">
                                                                                        <div class="esd-structure-type">
                                                                                            Container
                                                                                        </div>
                                                                                        <div class="esd-block-btn
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-save"
                                                                                                title="Save as module">
                                                                                                <a><span
                                                                                                        class="es-icon-save"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody class="ui-droppable">
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-m-txt-r esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <p
                                                                                                            style="line-height: 200%;">
                                                                                                            Subtot<strong>al
                                                                                                                (3
                                                                                                                items):</strong>
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-m-txt-r es-m-p10t esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <p
                                                                                                            style="line-height: 200%;">

                                                                                                            Shipping:
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-m-txt-r es-m-p10t esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <p
                                                                                                            style="line-height: 200%;">
                                                                                                            Discount:
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-m-txt-r es-m-p5t esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <h3
                                                                                                            style="line-height: 200%;">
                                                                                                            Order total:
                                                                                                        </h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td class="esdev-mso-td" valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-right" align="right">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td width="111" align="left"
                                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                                        esd-handler-name="containerHandler">
                                                                                        <div class="esd-structure-type">
                                                                                            Container
                                                                                        </div>
                                                                                        <div class="esd-block-btn
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-save"
                                                                                                title="Save as module">
                                                                                                <a><span
                                                                                                        class="es-icon-save"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody class="ui-droppable">
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-m-txt-r esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <h3><b>${{number_format($order->amount,2)}}</b>
                                                                                                        </h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-p5t es-m-txt-r esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <!-- <h3
                                                                                                            style="color: #c1312d;">
                                                                                                            <b>Free</b>
                                                                                                        </h3> -->
                                                                                                        <h3><b>${{number_format($order->shipping_amount,2)}}</b>
                                                                                                        </h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-p5t es-m-txt-r esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <h3><b>${{number_format($order->coupon_amount,2)}}</b>
                                                                                                        </h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr
                                                                                                    class="ui-draggable">
                                                                                                    <td align="right"
                                                                                                        class="esd-block-text es-p10t es-m-txt-r esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                                        esd-handler-name="textElementHandler">
                                                                                                        <div class="esd-block-btn
                                                                                    esd-no-block-library
                                                                                    ">
                                                                                                            <div
                                                                                                                class="esd-more">
                                                                                                                <a><span
                                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                                title="Move">
                                                                                                                <a><span
                                                                                                                        class="es-icon-move"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                                title="Copy">
                                                                                                                <a><span
                                                                                                                        class="es-icon-copy"></span></a>
                                                                                                            </div>
                                                                                                            <div class="esd-delete"
                                                                                                                title="Delete">
                                                                                                                <a><span
                                                                                                                        class="es-icon-delete"></span></a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <h3><b>${{number_format($order->total_amount,2)}}</b>
                                                                                                        </h3>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure es-p30t es-p40b es-p20r es-p20l esd-frame esd-hover esdev-disable-select"
                                                        align="left" esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            Structure
                                                        </div>
                                                        <div class="esd-block-btn
                                                ">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <!--[if mso]>
                                             <table width="560" cellpadding="0" cellspacing="0">
                                                <tr>
                                                   <td width="270" valign="top">
                                                      <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="270"
                                                                        class="esd-container-frame es-m-p20b esd-frame esd-hover esdev-disable-select"
                                                                        align="left"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                                     ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="left"
                                                                                        class="esd-block-text es-p20b esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h2>Summary</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="ui-draggable">
                                                                                    <td align="left"
                                                                                        class="esd-block-text esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <p>Order Date:&nbsp;<strong>{{\Carbon\Carbon::parse($order->ordered_at)->format('d/m/Y h:i A')}}</strong></p>
                                                                                        <p>Order Status:&nbsp;<strong>{{$order->order_status->label ?? ''}}</strong></p>
                                                                                        <hr>
                                                                                        <p>Payment Mode:&nbsp;<strong>{{ $order->payment_mode == 'card' ? 'Online' : 'Pay Now' }}</strong>
                                                                                        </p>
                                                                                        <p>Payment Status:&nbsp;<strong>{{  $order->payment_mode == 'pod' ? ($order->payment_status == 1 ? 'Paid' : 'Pending') :
                                    ($order->payment_status == 1 ? 'Paid' : 'Failed') }}</strong>
                                                                                        </p>
                                                                                            <hr>
                                                                                        <p>Delivery Type
                                                                                            :&nbsp;<strong>@if(!empty($shippingAddress)) {{$shippingAddress['address_type'] ?? '-'}} @else - @endif</strong>
                                                                                        </p>
                                                                                        <p>Delivery Date:&nbsp;<strong>
                                                                                            {{ !empty($order->preferred_delivery_date) ? \Carbon\Carbon::parse($order->preferred_delivery_date)->format('d/m/Y') : (!empty($order->expected_delivery_date) ? \Carbon\Carbon::parse($order->expected_delivery_date)->format('d/m/Y') : '-') }}
                                                                                        </strong></p>
                                                                                        <p>Delivery Slot:&nbsp;<strong>{{ !empty($order->delivery_slot) ? $order->delivery_slot : '-' }}</strong>
                                                                                        </p>
                                                                                        <p>Delivery Instructions:&nbsp;<br><strong>{{ !empty($order->delivery_instructions) ? $order->delivery_instructions : '-' }}</strong>
                                                                                        </p>
                                                                                        <hr>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                   </td>
                                                   <td width="20"></td>
                                                   <td width="270" valign="top">
                                                      <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right"
                                                            align="right">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="270"
                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                        align="left"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                                     ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="left"
                                                                                        class="esd-block-text es-p20b esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h2>Shipping address</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="ui-draggable">
                                                                                    <td align="left"
                                                                                        class="esd-block-text esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        @if(!empty($shippingAddress))
                                                                                        <p>{{$shippingAddress['name']}},</p>
                                                                                        <p>{{$shippingAddress['address']}},</p>
                                                                                        <p>{{$shippingAddress['city']}},
                                                                                        {{$shippingAddress['state']}},
                                                                                        {{countryName($shippingAddress['country_id'])->name.' - '.$shippingAddress['zipcode']}}
                                                                                        </p>
                                                                                        @endif
                                                                                        <p>Phone Number:&nbsp;<strong>{{$shippingAddress['mobile'] ?? '-'}}</strong>
                                                                                        </p>
                                                                                        <hr>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                   </td>
                                                </tr>
                                             </table>
                                             <![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content ui-draggable" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-hover" align="center"
                                        esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                              Content
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0" width="600" style="display:none">
                                            <tbody class="ui-droppable">
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure es-p30t es-p20b es-p20r es-p20l esd-frame esd-hover esdev-disable-select"
                                                        align="left" esd-custom-block-id="820642"
                                                        esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            Structure
                                                        </div>
                                                        <div class="esd-block-btn
                                                ">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="560"
                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                        align="center" valign="top"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                            ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p10t es-m-txt-c esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                        esd-no-block-library
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h2>Order more from {{env('APP_NAME')}}</h2>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- more order -->

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content ui-draggable" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-hover" align="center"
                                        esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                              Content
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table bgcolor="#fafafa" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0" width="600" style="background-color: #fafafa;">
                                            <tbody class="ui-droppable">
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure es-p30t es-p30b es-p20r es-p20l esd-frame esdev-disable-select esd-hover"
                                                        align="left" esdev-eq="true" esd-custom-block-id="820645"
                                                        esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            Structure
                                                        </div>
                                                        <div class="esd-block-btn
                                                ">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete" disabled="disabled">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <!--[if mso]>
                                             <table width="560" cellpadding="0" cellspacing="0">
                                                <tr>
                                                   <td width="270" valign="top">
                                                      <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="left"
                                                            class="es-left">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="270"
                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                        align="center" valign="top"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                                     ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-image es-p35 esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        style="font-size: 0px;"
                                                                                        esd-handler-name="imgBlockHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <a
                                                                                            href="javascript:(0);"><img
                                                                                                class="esdev-stretch-width"
                                                                                                src="{{ asset('frontend/email_assets/images/onlinepayment_4.png') }}"
                                                                                                alt=""
                                                                                                style="display: block;"
                                                                                                width="200"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                   </td>
                                                   <td width="20"></td>
                                                   <td width="270" valign="top">
                                                      <![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right"
                                                            align="right">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="270" align="left"
                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                                     ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p10t es-p10b es-m-txt-c esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <h2>We're here to help</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-button es-p10t es-p10b esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="btnBlockHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--[if mso]>
                                                                              <a href="tel:+(000)123456789" target="_blank" hidden>
                                                                                 <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="tel:+(000)123456789"
                                                                                    style="height:40px; v-text-anchor:middle; width:223px" arcsize="50%" stroke="f"  fillcolor="#f1ba0a">
                                                                                    <w:anchorlock></w:anchorlock>
                                                                                    <center style='color:#0f181a; font-family:Nunito, Roboto, sans-serif; font-size:14px; font-weight:700; line-height:14px;  mso-text-raise:1px'>+ (000) 123 456 789</center>
                                                                                 </v:roundrect>
                                                                              </a>
                                                                              <![endif]-->
                                                                                        <!--[if !mso]><!-- --><span
                                                                                            class="msohide es-button-border"><a
                                                                                                href="tel:+(65)000000"
                                                                                                class="es-button"
                                                                                                target="_blank">+ (65)
                                                                                                00 00 00<img
                                                                                                    src="{{ asset('frontend/email_assets/images/group_361.png') }}"
                                                                                                    alt="icon"
                                                                                                    width="20"
                                                                                                    class="esd-icon-right"
                                                                                                    align="absmiddle"
                                                                                                    style="margin-left: 10px;"></a></span>
                                                                                        <!--<![endif]-->
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="ui-draggable" style="display:none">
                                                                                    <td align="center"
                                                                                        class="esd-block-button es-p10t es-p20b esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="btnBlockHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--[if mso]>
                                                                              <a href="mailto:fresh_in_box@email" target="_blank" hidden>
                                                                                 <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="mailto:fresh_in_box@email"
                                                                                    style="height:40px; v-text-anchor:middle; width:218px" arcsize="50%" stroke="f"  fillcolor="#f1ba0a">
                                                                                    <w:anchorlock></w:anchorlock>
                                                                                    <center style='color:#0f181a; font-family:Nunito, Roboto, sans-serif; font-size:14px; font-weight:700; line-height:14px;  mso-text-raise:1px'>fresh_in_box@email</center>
                                                                                 </v:roundrect>
                                                                              </a>
                                                                              <![endif]-->
                                                                                        <!--[if !mso]><!-- --><span
                                                                                            class="msohide es-button-border"><a
                                                                                                href="mailto:fresh_in_box@email"
                                                                                                class="es-button"
                                                                                                target="_blank">fresh_in_box@email<img
                                                                                                    src="{{ asset('frontend/email_assets/images/group_361.png') }}"
                                                                                                    alt="icon"
                                                                                                    width="20"
                                                                                                    class="esd-icon-right"
                                                                                                    align="absmiddle"
                                                                                                    style="margin-left: 10px;"></a></span>
                                                                                        <!--<![endif]-->
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-text es-p20r es-p20l esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        esd-handler-name="textElementHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <p>also available in social
                                                                                            networks</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-social es-p15t es-p15b esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        style="font-size:0"
                                                                                        esd-handler-name="socialBlockHandler">
                                                                                        <div class="esd-block-btn
                                                                                 esd-no-block-library
                                                                                 ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            class="es-table-not-adapt es-social">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        valign="top"
                                                                                                        class="es-p10r">
                                                                                                        <a
                                                                                                            href="javascript:(0);"><img
                                                                                                                src="{{ asset('frontend/email_assets/images/facebook-circle-black.png') }}"
                                                                                                                alt="Fb"
                                                                                                                title="Facebook"
                                                                                                                width="32"></a>
                                                                                                    </td>
                                                                                                    <td align="center"
                                                                                                        valign="top"
                                                                                                        class="es-p10r">
                                                                                                        <a
                                                                                                            href="javascript:(0);"><img
                                                                                                                src="{{ asset('frontend/email_assets/images/twitter-circle-black.png') }}"
                                                                                                                alt="Tw"
                                                                                                                title="Twitter"
                                                                                                                width="32"></a>
                                                                                                    </td>
                                                                                                    <td align="center"
                                                                                                        valign="top"
                                                                                                        class="es-p10r">
                                                                                                        <a
                                                                                                            href="javascript:(0);"><img
                                                                                                                src="{{ asset('frontend/email_assets/images/instagram-circle-black.png') }}"
                                                                                                                alt="Ig"
                                                                                                                title="Instagram"
                                                                                                                width="32"></a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]>
                                                   </td>
                                                </tr>
                                             </table>
                                             <![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content ui-draggable" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-hover" align="center"
                                        esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                              Content
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-footer ui-draggable" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esdev-disable-select esd-hover" align="center"
                                        esd-custom-block-id="820649" esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                              Footer
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-footer esd-footer-popover ui-draggable"
                            align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe esd-frame esd-hover esdev-disable-select" align="center"
                                        esd-custom-block-id="797923" esd-handler-name="stripeBlockHandler">
                                        <div class="esd-structure-type">
                                              Footer
                                        </div>
                                        <div class="esd-block-btn
                                    ">
                                            <div class="esd-more"><a><span class="es-icon-dot-3"></span></a></div>
                                            <div class="esd-save" title="Save as module">
                                                <a><span class="es-icon-save"></span></a>
                                            </div>
                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                <a><span class="es-icon-move"></span></a>
                                            </div>
                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                <a><span class="es-icon-copy"></span></a>
                                            </div>
                                            <div class="esd-delete" title="Delete">
                                                <a><span class="es-icon-delete"></span></a>
                                            </div>
                                        </div>
                                        <div class="esd-add-stripe">
                                            <a><span class="es-icon-plus"></span></a>
                                            <div class="esd-stripes-popover esd-hidden-right">
                                                <div class="esd-popover-content">
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_100">
                                                        <div class="col-xs-12">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_50_50">
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_33_33">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_25_25_25_25">
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_33_66">
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                    <div class="esd-stripe-preview"
                                                        esd-element-name="structureType_66_33">
                                                        <div class="col-xs-8">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <a class="esd-structure-preview"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0"
                                            width="600" style="background-color: transparent;">
                                            <tbody class="ui-droppable">
                                                <tr class="ui-draggable">
                                                    <td class="esd-structure es-p20 esd-frame esd-hover esdev-disable-select"
                                                        align="left" esd-handler-name="structureBlockHandler">
                                                        <div class="esd-structure-type">
                                                            Structure
                                                        </div>
                                                        <div class="esd-block-btn
                                                ">
                                                            <div class="esd-more"><a><span
                                                                        class="es-icon-dot-3"></span></a></div>
                                                            <div class="esd-save" title="Save as module">
                                                                <a><span class="es-icon-save"></span></a>
                                                            </div>
                                                            <div class="esd-move ui-draggable-handle" title="Move">
                                                                <a><span class="es-icon-move"></span></a>
                                                            </div>
                                                            <div class="esd-copy ui-draggable-handle" title="Copy">
                                                                <a><span class="es-icon-copy"></span></a>
                                                            </div>
                                                            <div class="esd-delete" title="Delete" disabled="disabled">
                                                                <a><span class="es-icon-delete"></span></a>
                                                            </div>
                                                        </div>
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody class="ui-droppable">
                                                                <tr class="ui-draggable">
                                                                    <td width="560"
                                                                        class="esd-container-frame esd-frame esd-hover esdev-disable-select"
                                                                        align="left"
                                                                        esd-handler-name="containerHandler">
                                                                        <div class="esd-structure-type">
                                                                            Container
                                                                        </div>
                                                                        <div class="esd-block-btn
                                                            ">
                                                                            <div class="esd-more"><a><span
                                                                                        class="es-icon-dot-3"></span></a>
                                                                            </div>
                                                                            <div class="esd-save"
                                                                                title="Save as module">
                                                                                <a><span
                                                                                        class="es-icon-save"></span></a>
                                                                            </div>
                                                                            <div class="esd-move ui-draggable-handle"
                                                                                title="Move">
                                                                                <a><span
                                                                                        class="es-icon-move"></span></a>
                                                                            </div>
                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                title="Copy">
                                                                                <a><span
                                                                                        class="es-icon-copy"></span></a>
                                                                            </div>
                                                                            <div class="esd-delete" title="Delete">
                                                                                <a><span
                                                                                        class="es-icon-delete"></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%">
                                                                            <tbody class="ui-droppable">
                                                                                <tr class="ui-draggable">
                                                                                    <td align="center"
                                                                                        class="esd-block-image es-infoblock made_with esd-frame esd-hover esdev-disable-select esd-draggable esd-block"
                                                                                        style="font-size:0"
                                                                                        esd-handler-name="imgBlockHandler">
                                                                                        <div class="esd-block-btn
                                                                        esd-no-block-library
                                                                        ">
                                                                                            <div class="esd-more">
                                                                                                <a><span
                                                                                                        class="es-icon-dot-3"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-move ui-draggable-handle"
                                                                                                title="Move">
                                                                                                <a><span
                                                                                                        class="es-icon-move"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-copy ui-draggable-handle"
                                                                                                title="Copy">
                                                                                                <a><span
                                                                                                        class="es-icon-copy"></span></a>
                                                                                            </div>
                                                                                            <div class="esd-delete"
                                                                                                title="Delete">
                                                                                                <a><span
                                                                                                        class="es-icon-delete"></span></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
