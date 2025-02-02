# PHP Expense Tracker

A simple command-line expense tracker application built with PHP and Docker.

## Setup

1. Make sure you have Docker and Docker Compose installed
2. Clone this repository
3. Run the following commands:

```bash
docker-compose build
docker-compose up -d
```

## Usage

You can use the expense tracker in two ways:

### 1. From Outside the Container

```bash
# Add an expense
docker-compose exec php expense-tracker add --description "Lunch" --amount 20

# List all expenses
docker-compose exec php expense-tracker list

# Delete an expense
docker-compose exec php expense-tracker delete --id 1

# View expense summary
docker-compose exec php expense-tracker summary

# View monthly expense summary (e.g., for month 8 - August)
docker-compose exec php expense-tracker summary --month 8
```

### 2. From Inside the Container

First, enter the container:
```bash
docker-compose exec php bash
```

Then you can run commands directly:
```bash
# Add an expense
expense-tracker add --description "Lunch" --amount 20

# List all expenses
expense-tracker list

# Delete an expense
expense-tracker delete --id 1

# View expense summary
expense-tracker summary

# View monthly expense summary (e.g., for month 8 - August)
expense-tracker summary --month 8
```

To exit the container when you're done, simply type:
```bash
exit
```

## Data Storage

Expenses are stored in a JSON file located at `data/expenses.json`. The file is automatically created when you add your first expense.

## Project URL
[roadmap.sh PHP Expence Tracker Project](https://roadmap.sh/projects/expense-tracker)
