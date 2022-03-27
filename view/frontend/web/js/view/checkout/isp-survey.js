define(
    [
        'jquery',
        'uiComponent',
		'knockout',
        'Magento_Checkout/js/model/quote',
        'mage/storage',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Checkout/js/model/full-screen-loader',
        'Magento_Checkout/js/model/url-builder'
    ],
    function ($, Component, ko, quote, storage, errorProcessor, fullScreenLoader, urlBuilder) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Kemana_IspSurvey/checkout/isp-survey'
            },

            initialize: function() {
                this._super();
                var self = this;
            },
			
            /**
             * Check the user isp-survey enable or not
             *
             * @return {bool}
             */				
            isDisplayed: function () {
              return window.checkoutConfig.allow_detect_isp;
            },


            setIsp: function (obj, event) {
                var serviceUrl = urlBuilder.createUrl('/set-isp', {});
                var satisfied = $("input.satisfied:checked").val();
                var payload = {
                    cartId: quote.getQuoteId(),
                    isp: $("#current_isp").val(),
                    isSatisfied: event.target.value 
                };

                fullScreenLoader.startLoader();

                storage.post(
                    serviceUrl, JSON.stringify(payload)
                ).always(
                    function (response) {
                        fullScreenLoader.stopLoader();
                        $('body').trigger('contentUpdated');
                    }
                );

                return true;
            },

            /**
             * get Checkout Field Question
             *
             * @return string
             */             
            getIspQuestion: function () {
                let ispdata = '';
                async function getIspData() {
                    let response = await fetch('http://ip-api.com/json');
                    let data = await response.json();
                    ispdata = data.isp;
                    let question = 'You are using "'+ispdata+'" for your internet connection. Are you satisfied with your current internet connection provider?';
                    $('.isp-question').html(question);
                    $('#current_isp').val(ispdata);
                    return data;
                }

                getIspData().then();
            }
        });
    }
);
