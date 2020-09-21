<?php

function getLightValidationRules() {
  $rules = [
    'name' => ['required', 'max:255', 'string'],
    'location' => ['required', 'max:255', 'string'],
    'ip_address' => ['required', 'max:255', 'ip']
  ];

  return $rules;
}

function getServiceValidationRules() {
  $rules = [
    'name' => ['required', 'max:255', 'string']
  ];

  return $rules;
}

function getTokenRequestValidationRules() {
  $rules = [
    'name' => ['required', 'max:255', 'string']
  ];

  return $rules;
}

function getAnimationValidationRules() {
  $rules = [
    'name' => ['required', 'max:255', 'string']
  ];

  return $rules;
}
