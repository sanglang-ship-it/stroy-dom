// ==============================================
// КАЛЬКУЛЯТОР СТОИМОСТИ СТРОИТЕЛЬСТВА
// ==============================================

function calculateCost() {
    // Получаем значения из формы
    var area = parseFloat(document.getElementById('area').value) || 0;
    var material = document.getElementById('material').value;
    var floors = parseInt(document.getElementById('floors').value) || 1;

    // Стоимость за 1 м² в зависимости от материала (в рублях)
    var prices = {
        'kirpich': 8500,      // кирпич
        'gazobeton': 5500,    // газобетон
        'brus': 7500,         // брус
        'karkas': 4500        // каркас
    };

    // Коэффициент этажности (чем больше этажей, тем дороже)
    var floorCoef = {
        1: 1.0,
        2: 1.15,
        3: 1.3
    };

    // Стоимость проектирования (фиксированная)
    var projectCost = 25000;

    // Проверяем, что площадь введена
    if (area <= 0) {
        document.getElementById('result').innerHTML =
            '<span style="color: red;">Пожалуйста, введите площадь дома</span>';
        return;
    }

    // Считаем стоимость
    var pricePerM2 = prices[material] || 0;
    var coef = floorCoef[floors] || 1.0;
    var totalCost = (area * pricePerM2 * coef) + projectCost;

    // Форматируем число (с пробелами между разрядами)
    var formattedCost = totalCost.toLocaleString('ru-RU');

    // Выводим результат
    document.getElementById('result').innerHTML =
        '<div style="background: #E67E22; color: #fff; padding: 20px; border-radius: 10px; text-align: center;">' +
        '<p style="margin: 0; font-size: 16px;">Примерная стоимость строительства:</p>' +
        '<p style="margin: 10px 0 0; font-size: 28px; font-weight: bold;">' + formattedCost + ' руб.</p>' +
        '<p style="margin: 10px 0 0; font-size: 14px;">* Расчёт является предварительным</p>' +
        '</div>';
}