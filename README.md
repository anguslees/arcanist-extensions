# Arcanist Extensions

This project provides some useful extensions for [Arcanist](https://github.com/phacility/arcanist).

## Installation

The easiest way to include some (or all) the extensions on your own projects is by adding this repository as git submodule, given you are using git (which you obviously should):

`git submodule update  --init git@github.com:tagview/arcanist-extensions.git .arcanist-extensions`

Then, just list the desired extensions on the `load` key of your project's `.arcconfig` file.

```json
{
  "project_id": "my-awesome-project",
  "conduit_uri": "https://example.org",
  
  "load": [
    ".arcanist-extensions/[extension_name]"
  ]
}
```

## Available extensions

### `rubocop_linter`

This extension will lint your project using the awesome [Rubocop](https://github.com/bbatsov/rubocop) library. It is important to mention that the extension won't install Rubocop, so you must do it manually and make sure you have the `rubocop` executable listed on your `$PATH`. 

If you need to customize the default style rules, just create a `.rubocop.yml` file on the root of your project as you would normally do.