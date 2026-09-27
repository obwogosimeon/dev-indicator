 @if($imp->reporting_frequency == '1' && $reportingf == 'Quaterly')
 <span class="badge bg-warning">Quater One</span>
 @elseif($imp->reporting_frequency == '1' && $reportingf == 'Monthly')
 <span class="badge bg-warning">First Month</span>
 @elseif($imp->reporting_frequency == '1' && $reportingf == 'BiMonthly')  
 <span class="badge bg-warning">First BI-Monthly</span>
 @elseif($imp->reporting_frequency == '1' && $reportingf == 'SemiAnnual')  
 <span class="badge bg-warning">First Semi-Annual</span>     
 @elseif($imp->reporting_frequency == '1' && $reportingf == 'Annual')  
 <span class="badge bg-warning">Annual</span>

 @elseif($imp->reporting_frequency == '2' && $reportingf == 'Quaterly')   
 <span class="badge bg-warning">Quater Two</span>
 @elseif($imp->reporting_frequency == '2' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Second Month</span>
 @elseif($imp->reporting_frequency == '2' && $reportingf == 'BiMonthly')  
 <span class="badge bg-warning">Second BI-Monthly</span>
 @elseif($imp->reporting_frequency == '2' && $reportingf == 'SemiAnnual')  
 <span class="badge bg-warning">Last Semi-Annual</span>

 @elseif($imp->reporting_frequency == '3' && $reportingf == 'Quaterly')   
 <span class="badge bg-warning">Third Quarter</span>
 @elseif($imp->reporting_frequency == '3' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Third Month</span>
 @elseif($imp->reporting_frequency == '3' && $reportingf == 'BiMonthly')  
 <span class="badge bg-warning">Third BI-Monthly</span>  

 @elseif($imp->reporting_frequency == '4' && $reportingf == 'Quaterly')
 <span class="badge bg-warning">Last Quarter</span>
 @elseif($imp->reporting_frequency == '4' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Fourth Month</span>
 @elseif($imp->reporting_frequency == '4' && $reportingf == 'BiMonthly')  
 <span class="badge bg-warning">Fourth BI-Monthly</span>

 @elseif($imp->reporting_frequency == '5' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Fifth Month</span>
 @elseif($imp->reporting_frequency == '5' && $reportingf == 'BiMonthly')  
 <span class="badge bg-warning">Fifth BI-Monthly</span>

 @elseif($imp->reporting_frequency == '6' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Sixth Month</span>
 @elseif($imp->reporting_frequency == '6' && $reportingf == 'BiMonthly')  
 <span class="badge bg-warning">Last BI-Monthly</span> 

 @elseif($imp->reporting_frequency == '7' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Seventh Month</span>  
 @elseif($imp->reporting_frequency == '8' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Eighth Month</span>  
 @elseif($imp->reporting_frequency == '9' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Ninth Month</span>  
 @elseif($imp->reporting_frequency == '10' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Tenth Month</span>  
 @elseif($imp->reporting_frequency == '11' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Eleventh Month</span>  
 @elseif($imp->reporting_frequency == '12' && $reportingf == 'Monthly')
 <span class="badge bg-warning">Twelfth Month</span>  
 @endif   