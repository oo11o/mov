import { test, expect } from '@playwright/test';

test('example test', async ({ page }) => {
    await page.goto('http://localhost');
    await expect(page).toHaveTitle(/Laravel/);
});
