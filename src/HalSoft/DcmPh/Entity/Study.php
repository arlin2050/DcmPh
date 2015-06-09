<?php
namespace HalSoft\DcmPh\Entity;

use HalSoft\DcmPh\Dcmtk\DicomDictionary;
/**
 *
 * @author Luca Saba <luca.saba@halsoftware.org>
 */

class Study extends DicomResponse implements DicomObjectInterface
{
    public function getInstanceUID()
    {
        if(isset($this->dicom_tags[DicomDictionary::STUDY_INSTANCE_UID])) {
            return $this->dicom_tags[DicomDictionary::STUDY_INSTANCE_UID];
        }
        return false;
    }
    
    public function getId()
    {
        if(isset($this->dicom_tags[DicomDictionary::STUDY_ID])) {
            return $this->dicom_tags[DicomDictionary::STUDY_ID];
        }
        return false;
    }
    
    public function getDateTime($format = null)
    {
        if(!isset($this->dicom_tags[DicomDictionary::STUDY_DATE]) || !isset($this->dicom_tags[DicomDictionary::STUDY_TIME])) {
            return false;
        }
        $res = \DateTime::createFromFormat('YmdHis.u', $this->dicom_tags[DicomDictionary::STUDY_DATE].$this->dicom_tags[DicomDictionary::STUDY_TIME]);

        if(!$res) {
            return null;
        }

        if($format == null) {
            return $res;
        } else {
            return $res->format($format);
        }
    }
    
    public function getDescription()
    {
        if(isset($this->dicom_tags[DicomDictionary::STUDY_DESCRIPTION])) {
            return $this->dicom_tags[DicomDictionary::STUDY_DESCRIPTION];
        }
        return false;
    }

    public function getPatientId()
    {
        if(isset($this->dicom_tags[DicomDictionary::PATIENT_ID])) {
            return $this->dicom_tags[DicomDictionary::PATIENT_ID];
        }
        return false;
    }
}
