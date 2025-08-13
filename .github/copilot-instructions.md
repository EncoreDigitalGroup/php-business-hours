# GitHub Copilot Repository Context

## Project Description

Business Hours is a PHP library meant to wrap spatie/opening-hours and cmixin/business-day in a typesafe manner.

## Technology Stack

- PHP 8.3+

## Coding Standards

Use the following as a baseline for PHP Coding Standards:

- PHP code follows PSR-12 and Laravel conventions
- Use strong typing and return type declarations

We stray from the baseline coding standards in the following ways:

- We always use double quotes instead of single quotes.
- PHP variables in strings should always look like this: `"Here is an example string with a {$variable} in it."`

## Testing Standards

- For PHP tests, we always use PestPHP.
- When writing PestPHP tests:
    - Use the `test()` function instead of the `it()` function.
    - Under no circumstances should you mock any code ever.
      The only exception to this rule is if you are explicitly instructed to mock.
    - Similar tests should always be grouped inside of a describe block.

## Misc

- You are only to answer the question that is asked of you. Do not try to infer what additional tasks may need to be completed.
  If you think that more context may be required to fully answer the question, stop and ask the user for the context that you think you need.
- The user may not give you additional context when you ask for it. In that case, you should only do what is absolutely required to answer
  the users question.
- When reviewing a PR, do not comment on anything related to code style. We have CI processes in place to apply the proper coding styling automatically.
  You should only ever care about coding style when generating code upon request.