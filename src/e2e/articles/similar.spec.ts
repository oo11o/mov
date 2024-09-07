import { test, expect } from '@playwright/test';

const baseUrl = process.env.BASE_URL || 'http://localhost';

const similarUrl = `${baseUrl}/similar`;
const similarArticleUrl = `${similarUrl}/similar-slug-test`;
const similarArticleNoExist = `${similarUrl}/no-exist-article`;

test('display similar article', async ({ page }) => {
    const response = await page.goto(similarArticleUrl);
    expect(response.status()).toBe(200);



    const metaDescription = await page.locator('meta[name="description"]').getAttribute('content');
    expect(metaDescription).toBe('similar-description-test');

    const h1Text = await page.locator('h1').textContent();
    await expect(h1Text).toBe('similar-h1-test');
});

test(' display 404 when article not found in similar category', async ({ page }) => {
    const response = await page.goto(similarArticleNoExist);

    expect(response.status()).toBe(404);
    await expect(page).toHaveTitle('Not Found');
});
