
    /*
     * 生成级联菜单
     */
    $.fn.extend({
        birthday : function (a , b , c , d , e){
            var date = new Date();
            var year = date.getFullYear();//获取当前年份
            var i = year;
            var dropList = '';
            for(i;i > year - e; i--){
                dropList += "<li>"+i+"</li>";
            }
            $(this).find( a + ' ul').html(dropList);//生成年份下拉菜单
            var monthly = '';
            for(var month=1;month<13;month++){
                monthly = monthly + "<li>"+month+"</li>";
            }
            $(this).find( b + ' ul').html(monthly);//生成月份下拉菜单
            var dayly = '';
            for(var day=1;day<=31;day++){
                dayly = dayly + "<li>"+day+"</li>";
            }
            $(this).find( c + ' ul').html(dayly);//生成天数下拉菜单
            /*
             * 处理每个月有多少天---联动
             */
            $(this).find( b + ' ul li').click(function(){
                var currentDay = '';
                var Flag = $(this).parents(d).children(a).find('span').html();
                var currentMonth = $(this).html();
                $(this).parents(d).children(c).find('span').html('1');
                var total;
                switch(currentMonth){
                    case "1" :
                    case "3" :
                    case "5" :
                    case "7" :
                    case "8" :
                    case "10" :
                    case "12" :total = 31;break;
                    case "4" :
                    case "6" :
                    case "9" :
                    case "11" :total = 30;break;
                    case "2" :
                        if((Flag%4 == 0 && Flag%100 != 0) || Flag%400 == 0){
                            total = 29;
                        }else{
                            total = 28;
                        }
                    default:break;
                }
                
                for(var day=1;day <= total;day++){
                    currentDay = currentDay + "<li>"+day+"</li>";
                };
                $(this).parents(d).children(c).find('ul').html(currentDay);//生成日期下拉菜单
                
                chooseDown('adult-information-birth-day');
                chooseDown('children-information-birth-day');
                chooseDown('birth-day');
                
            });
        }
    });
