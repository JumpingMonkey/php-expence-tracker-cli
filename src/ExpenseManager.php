<?php

class ExpenseManager {
    private string $dataFile = __DIR__ . '/../data/expenses.json';

    public function __construct() {
        $this->initializeDataFile();
    }

    private function initializeDataFile(): void {
        if (!file_exists(dirname($this->dataFile))) {
            mkdir(dirname($this->dataFile), 0777, true);
        }
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([]));
        }
    }

    public function addExpense(string $description, float $amount): int {
        $expenses = $this->loadExpenses();
        $id = count($expenses) + 1;
        
        $expenses[] = [
            'id' => $id,
            'description' => $description,
            'amount' => $amount,
            'date' => date('Y-m-d')
        ];
        
        $this->saveExpenses($expenses);
        return $id;
    }

    public function deleteExpense(int $id): void {
        $expenses = $this->loadExpenses();
        $expenses = array_filter($expenses, fn($expense) => $expense['id'] != $id);
        $this->saveExpenses(array_values($expenses));
    }

    public function listExpenses(): array {
        return $this->loadExpenses();
    }

    public function getTotalExpenses(): float {
        $expenses = $this->loadExpenses();
        return array_reduce($expenses, fn($sum, $expense) => $sum + $expense['amount'], 0.0);
    }

    public function getMonthlySummary(int $month): float {
        $expenses = $this->loadExpenses();
        $filtered = array_filter($expenses, function($expense) use ($month) {
            $expenseMonth = (int)date('n', strtotime($expense['date']));
            $expenseYear = (int)date('Y', strtotime($expense['date']));
            return $expenseMonth === $month && $expenseYear === (int)date('Y');
        });
        
        return array_reduce($filtered, fn($sum, $expense) => $sum + $expense['amount'], 0.0);
    }

    private function loadExpenses(): array {
        $content = file_get_contents($this->dataFile);
        return json_decode($content, true) ?? [];
    }

    private function saveExpenses(array $expenses): void {
        file_put_contents($this->dataFile, json_encode($expenses, JSON_PRETTY_PRINT));
    }
}
