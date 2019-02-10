# Guidebook > Constraints

Due to the nature of this project, it will not be interfacing with any existing code, so constraints are at a minimum.

## Target Deployment Platform

SDR will be deployed on modern, immutable platforms (Heroku, Google App Engine, Docker). As such, any files created during the application's operation need to be via an external file store. This includes images uploaded and reports generated.

## Technology

The primary codebase will be written in PHP 7.2, with the standard extensions available. 
