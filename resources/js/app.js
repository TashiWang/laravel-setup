window._ = require('lodash');
require('./bootstrap');
require('./common');
require('./custom/roles');
require('./custom/permissions');

import Alpine from 'alpinejs';


/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import '@popperjs/core'

window.Alpine = Alpine;

Alpine.start();

require('admin-lte');



