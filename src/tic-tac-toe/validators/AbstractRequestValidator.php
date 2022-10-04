<?php

abstract class AbstractRequestValidator
{
    private $mandatory_fields = [];
    private $fixed_domain_field = [];


    public function __construct($mandatory_fields, $fixed_domain_field )
    {
        $this->mandatory_fields = $mandatory_fields;
        $this->fixed_domain_field = $fixed_domain_field;

    }
   
    public function validateRequest(array $request)
    {
        $validationErrors = [];
        $request_keys = array_keys($request);
        //Check for missing mandatory fields
        foreach ($this->mandatory_fields as $f) {
            if (!in_array($f, $request_keys)) {
                $validationErrors[] = "Missing mandatory params {$f}";
            }
        }

         //Check for specific domain in request paramenters
         foreach ($request_keys as $f) {
            //Check fixed domain field
            $domain = $this->fixed_domain_field[$f];
            if (!empty($domain)) {
                $errors = $this->validateFieldDomain($domain, $request[$f]);
                if (!empty($errors)) $validationErrors[] = $errors;
            }
        }

        if($additionalError = $this->additionalChecks($request) )
            $validationErrors[] = $additionalError;

        if(count($validationErrors) > 0){
            throw new Exception("Validation errors: ". implode(", ", $validationErrors));
        }
    }

    protected function validateFieldDomain($domain, $value): string
    {
        //Domain validation
        $validationError = '';
        switch ($domain['type']) {
            case 'string':
                if (!in_array($value, $domain['values'])) {
                    $validationError = 'Invalid domain for ' . $domain['label'];
                    break;
                }
                break;
            case 'int':
                if (!is_numeric($value)  ||  intval($value) < 0) {
                    $validationError = 'Invalid ' . $domain['label'] . ' requested';
                    break;
                }
                break;
            case 'range':
                if (!is_numeric($value)  ||  intval($value) < $domain['values'][0] || intval($value) > $domain['values'][1]) {
                    $validationError = 'Invalid ' . $domain['label'] . ' requested';
                    break;
                }
                break;
        }
        return $validationError;
    }
    
    protected function additionalChecks(array $request):string {return '' ;}

}