(function () {
    'use strict';

    var statusElements = Array.prototype.slice.call(document.querySelectorAll('[data-integration-status]'));
    var refreshInterval = 60000;
    var requestTimeout = 4000;

    function setStatus(element, available) {
        var state = available ? 'available' : 'unavailable';
        var label = available ? 'Available' : 'Unavailable';
        var link = element.closest('a');

        element.classList.remove('integration-status--checking', 'integration-status--available', 'integration-status--unavailable');
        element.classList.add('integration-status--' + state);
        element.setAttribute('aria-label', 'Service ' + label.toLowerCase());
        element.setAttribute('title', 'Service ' + label.toLowerCase());
        element.querySelector('.integration-status__text').textContent = label;

        if (link) {
            link.classList.toggle('is-available', available);
            link.classList.toggle('is-unavailable', !available);
        }
    }

    function checkStatus(url, elements) {
        var controller = new AbortController();
        var timeout = window.setTimeout(function () {
            controller.abort();
        }, requestTimeout);

        return fetch(url, {
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json' },
            signal: controller.signal
        }).then(function (response) {
            if (!response.ok) {
                throw new Error('Status check failed');
            }

            return response.json();
        }).then(function (result) {
            elements.forEach(function (element) {
                setStatus(element, result.available === true);
            });
        }).catch(function () {
            elements.forEach(function (element) {
                setStatus(element, false);
            });
        }).then(function () {
            window.clearTimeout(timeout);
        });
    }

    function refreshStatuses() {
        var groupedElements = statusElements.reduce(function (groups, element) {
            var url = element.getAttribute('data-status-url');

            if (!groups[url]) {
                groups[url] = [];
            }

            groups[url].push(element);
            return groups;
        }, {});

        return Promise.all(Object.keys(groupedElements).map(function (url) {
            return checkStatus(url, groupedElements[url]);
        }));
    }

    if (statusElements.length) {
        refreshStatuses();
        window.setInterval(refreshStatuses, refreshInterval);
    }
}());
