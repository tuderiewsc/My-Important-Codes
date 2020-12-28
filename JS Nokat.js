 let eligibleInputs = Array.from(document.querySelectorAll('input[name="selectedSite"]'))
                 .filter(input => selectedCityIds.indexOf(input.getAttribute('city_id')) != -1);
            
             eligibleInputs.forEach(input => $(input).prop('checked', true));