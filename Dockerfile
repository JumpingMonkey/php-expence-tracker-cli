FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN chmod +x expense-tracker
RUN chmod +x expence-tracker

RUN ln -s /app/expence-tracker /usr/local/bin/expence-tracker
