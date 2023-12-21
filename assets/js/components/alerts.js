'use strict';

/**
 * Submits a form to the specified URL using the provided class name.
 *
 * @param {string} type 
 * @param {string} message 
 * @param {string} icon 
 */

export function bsAlert(type, message, icon) {
    return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
              ${icon} ${message}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
  } 